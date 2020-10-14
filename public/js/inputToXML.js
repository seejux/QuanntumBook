function convertChapterToXML(chapterNumber, subChapterNumber, isTwoLevel, chaptersXMLFile) {
  let enclosingTag;
  if(chapterNumber === 0) enclosingTag = "about";
  else enclosingTag = subChapterNumber === 0 ? "chapter" : "subchapter";

  chapterXML = loadChapterInfoFromInputsToXML(enclosingTag, chapterNumber, subChapterNumber);
  if(chapterXML == null) return;

  let xmlChapters = new DOMParser().parseFromString(chaptersXMLFile,"text/xml");
  let subChaptersTag;

  if(!isTwoLevel) {
      chapterXML += "<content>";

      let blocksInOrder = $("#block-container").children();
      blocksInOrder.each(function() {
        let block = $(this);
        let select = block.find("select");

        if(select.val() === "Heading") chapterXML += loadHeadingFromBlockIntoXML(block);
        else if(select.val() === "Paragraph") chapterXML += loadParagraphFromBlockIntoXML(block);
        else if(select.val() === "Quote") chapterXML += loadQuoteFromBlockIntoXML(block);
        else if(select.val() === "Separator") chapterXML += "<hr/>";
        else if(select.val() === "Image") chapterXML += loadImageFromBlockIntoXML(block);
        else if(select.val() === "Button") chapterXML += loadButtonFromBlockIntoXML(block);
      });

      chapterXML += "</content>";
  }
  else {
      try {
          subChaptersTag = xmlChapters.getElementsByTagName("chapter")[chapterNumber - 1].getElementsByTagName("subchapters")[0];
      }
      catch {
          chapterXML += "<subchapters></subchapters>";
      }
  }
  chapterXML += "</" + enclosingTag + ">";

  let xmlNewChapter = new DOMParser().parseFromString(chapterXML, "text/xml").getElementsByTagName(enclosingTag)[0];

  if(subChaptersTag != null) xmlNewChapter.appendChild(subChaptersTag);

  let oldChapter = xmlChapters.getElementsByTagName("chapter")[chapterNumber - 1];

  // About section
  if(chapterNumber === 0) xmlChapters = xmlNewChapter;
  else if(subChapterNumber !== 0) {
      let oldChapterParent = oldChapter.getElementsByTagName("subchapters")[0];

      oldChapter = oldChapter.getElementsByTagName("subchapters")[0].getElementsByTagName("subchapter")[subChapterNumber - 1];
      if(oldChapter == null) oldChapterParent.appendChild(xmlNewChapter);
      else oldChapter.replaceWith(xmlNewChapter);
  }
  else {
      if(oldChapter == null) xmlChapters.childNodes[0].appendChild(xmlNewChapter);
      else oldChapter.replaceWith(xmlNewChapter);
  }

  return xmlChapters;
}

function convertQuizToXML(quizNumber, quizzesXMLFile) {
   quizXML = loadQuizInfoFromInputsToXML();
   if(quizXML == null) return;

   const shuffleQuestions = $("#shuffle-questions-checkbox").prop("checked");

   quizXML += '<questions shuffle="' + shuffleQuestions + '">';

   let blocksInOrder = $("#block-container").children();
   blocksInOrder.each(function() {
       let block = $(this);
       quizXML += "<question-body>";

       if(block.find(".image-link-input").val().length > 0) quizXML += '<img src="' + block.find(".image-link-input").val() + '" />';

       quizXML += "<question>" + block.find(".question-input").val() + "</question>";
       quizXML += "<answer>" + block.find(".answer-input").val() + "</answer>";

       let i = 0;
       block.find(".option-input").each(function(){
           if(block.find(".option-correct:eq(" + i + ")").prop("checked")) quizXML += '<option correct="true">' + $(this).val() + "</option>";
           else quizXML += "<option>" + $(this).val() + "</option>";
           i++;
       });
       quizXML += "</question-body>";
   });

   quizXML += "</questions>";
   quizXML += "</quiz>";

   let xmlQuizzes = new DOMParser().parseFromString(quizzesXMLFile,"text/xml");
   let xmlNewQuiz = new DOMParser().parseFromString(quizXML, "text/xml").getElementsByTagName("quiz")[0];
   let oldQuiz = xmlQuizzes.getElementsByTagName("quiz")[quizNumber - 1];

   if(oldQuiz == null) xmlQuizzes.childNodes[0].appendChild(xmlNewQuiz);
   else oldQuiz.replaceWith(xmlNewQuiz);

   return xmlQuizzes;
}

function loadHeadingFromBlockIntoXML(block) {
    let value = block.find(".heading-input").val();
    return "<h>" + value + "</h>";
}

function loadParagraphFromBlockIntoXML(block) {
  let text = block.find("textarea").val();
  text = text.replace(/\n/g, '\\n');

  return "<p>" + text + "</p>";
}

function loadQuoteFromBlockIntoXML(block) {
  let text = block.find("textarea").val();
  text = text.replace(/\n/g, '\\n');

  return '<p type="quote">' + text + "</p>";
}

function loadImageFromBlockIntoXML(block) {
  let imageLink = block.find(".image-link-input").val();
  let imageWidth = block.find(".image-width-input").val();
  let invertImage = block.find(".invert-checkbox").prop("checked");


  if(imageWidth != null && imageWidth.length > 1) return `<img src="${imageLink}" width="${imageWidth}" invert="${invertImage}"/>`;
  return `<img src="${imageLink}" invert="${invertImage}"/>`;
}

function loadButtonFromBlockIntoXML(block) {
  let buttonText = block.find(".button-text-input").val();
  let actionParameter = block.find(".button-action-input").val();
  let radioValue = $('#' + block.attr("id") + ' input:checked').val();

  let buttonAction = "";
  if(radioValue === "Open Quiz") buttonAction = "open-quiz";
  else if(radioValue === "Open Link") buttonAction = "link";
  else if(radioValue === "Email") buttonAction = "email";

  if(block.find(".light-button-theme-checkbox").prop("checked")) return `<button theme="light" ${buttonAction}="${actionParameter}" >${buttonText}</button>`;
  return `<button ${buttonAction}="${actionParameter}" >${buttonText}</button>`;
}

function loadChapterInfoFromInputsToXML(chapterOrSubchapterTag, chapterNumber, subChapterNumber) {
   let title = $("#title-input").val();
   let description = $("#description-input").val();;
   let iconSource = $("#icon-input").val();;
   let themeName = $("#themes").find("input[type=radio]:checked").attr("id");

   if(subChapterNumber !== 0) {
     if(!chapterInfoValid(title, description, iconSource, "ignore")) return null;
   }
   else if(!chapterInfoValid(title, description, iconSource, themeName)) return null;

   const premiumChapter = $("#premium-checkbox").prop("checked");


   if(themeName == null) chapterXML = '<' + chapterOrSubchapterTag + ' premium="' + premiumChapter + '">';
   else chapterXML = '<' + chapterOrSubchapterTag + ' theme="' + themeName + '" premium="' + premiumChapter + '">';

   chapterXML += "<title>" + title + "</title>";
   if(chapterNumber === 0) chapterXML += "<author>" + description + "</author>";
   else chapterXML += "<description>" + description + "</description>";
   chapterXML += '<icon src="' + iconSource + '"/>';

   return chapterXML;
}

function loadQuizInfoFromInputsToXML() {
   let title = $("#title-input").val();
   let description = $("#description-input").val();;
   let themeName = $("#themes").find("input[type=radio]:checked").attr("id");

   if(!chapterInfoValid(title, description, "ignore", themeName)) return null;

   const premiumQuiz = $("#premium-checkbox").prop("checked");

   quizXML = '<quiz theme="' + themeName + '"  premium="' + premiumQuiz + '">';
   quizXML += "<title>" + title + "</title>";
   quizXML += "<description>" + description + "</description>";

   return quizXML;
}


function chapterInfoValid(title, description, iconSource, themeName) {
    let valid = true;
    if(title.length < 1) {
      $("#title-error-label").text("Chapter must have a title.");
      valid = false;
    }
    if(description.length < 1) {
      $("#description-error-label").text("Chapter must have a description.");
      valid = false;
    }
    if (iconSource.length < 1) {
      $("#icon-error-label").text("Chapter must have an icon.");
      valid = false;
    }
    if (themeName == null) {
      $("#theme-error-label").text("Chapter must have a theme.");
      valid = false;
    }
    return valid;
}


function saveOptionsToXML(optionsXMLFile) {
   let optionsXML = '<app theme="Theme1">';

   let themeName = $("#themes").find("input[type=radio]:checked").attr("id");

   if(themeName != null) optionsXML += "<theme>" + themeName.replace("Theme","Menu") + "</theme>";

   optionsXML += "<app-name>" + $("#app-name-input").val() + "</app-name>";

   if($("#enable-theory-checkbox").prop("checked")) optionsXML += "<enable-theory>true</enable-theory>";
   else optionsXML += "<enable-theory>false</enable-theory>";

   if($("#enable-tests-checkbox").prop("checked")) optionsXML += "<enable-tests>true</enable-tests>";
   else optionsXML += "<enable-tests>false</enable-tests>";

   if($("#enable-support-checkbox").prop("checked")) optionsXML += "<enable-support>true</enable-support>";
   else optionsXML += "<enable-support>false</enable-support>";

   if($("#enable-appname-checkbox").prop("checked")) optionsXML += "<enable-appname>true</enable-appname>";
   else optionsXML += "<enable-appname>false</enable-appname>";

   if($("#enable-tabs-checkbox").prop("checked")) optionsXML += "<enable-tabs>true</enable-tabs>";
   else optionsXML += "<enable-tabs>false</enable-tabs>";

   if($("#enable-ads-checkbox").prop("checked")) optionsXML += "<enable-ads>true</enable-ads>";
   else optionsXML += "<enable-ads>false</enable-ads>";

   optionsXML += "<time-between-ads>" + $("#time-between-ads").val() + "</time-between-ads>";

   optionsXML += "</app>";

   $("#xmlFileInput").val(html_beautify(optionsXML));
   $("#postAppOptionsForm").submit();
}

function exportAsXMLFile(xmlFile, name) {
   let blob = new Blob([xmlFile], {type: "text/xml; charset=utf-8"});
   saveAs(blob, name);
}

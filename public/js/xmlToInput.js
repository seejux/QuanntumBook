function loadChapterFromXML(chapterNumber, subChapterNumber, chaptersXMLFile) {
    let parser = new DOMParser();
    let xmlChapters = parser.parseFromString(chaptersXMLFile,"text/xml");


    let chapter = null;
    if(chapterNumber === 0) chapter = xmlChapters.getElementsByTagName("about")[0];
    else chapter = xmlChapters.getElementsByTagName("chapter")[chapterNumber - 1];

    // Chapter does not exist
    if(chapter == null) return;

    if(subChapterNumber !== 0) {
        chapter = chapter.getElementsByTagName("subchapter")[subChapterNumber - 1];
        // Subchapter does not exist
        if(chapter == null) return;
    }

    // Chapter or subchapter exists, enable delete button
    $("#deleteParentChapter").prop("disabled", false);
    $("#deleteChapter").prop("disabled", false);

    if(chapterNumber !== 0) loadChapterOrQuizInfoFromXMLToInputs(chapter);
    else loadAboutInfoFromXMLToInputs(chapter);

    if (subChapterNumber !== 0 && chapter.getElementsByTagName("subchapter")[0] != null) return;

    let contentTag = chapter.getElementsByTagName("content")[0];
    if(contentTag == null) return;

    if(chapter.getAttribute("premium") != null && chapter.getAttribute("premium") === "true") $("#premium-checkbox").prop("checked", true);

    let contentNodes = [...contentTag.childNodes];
    contentNodes.forEach(function(e) {
      if(e.tagName != null) {
        let block = addBlock();
        loadContentOfBlockFromXML(block, e);
      }
    });
  }

function loadQuizFromXML(quizNumber, quizzesXMLFile) {
    let xmlQuizzes = new DOMParser().parseFromString(quizzesXMLFile,"text/xml");

    let quiz = xmlQuizzes.getElementsByTagName("quiz")[quizNumber - 1];
    // Quiz does not exist
    if(quiz == null) return;

    // Quiz loaded, enable delete button
    $("#deleteQuiz").prop("disabled", false);

    loadChapterOrQuizInfoFromXMLToInputs(quiz);

    let questionsTag = quiz.getElementsByTagName("questions")[0];
    if(questionsTag == null) return;

    if(questionsTag.getAttribute("shuffle") != null && questionsTag.getAttribute("shuffle") === "true") $("#shuffle-questions-checkbox").prop("checked", true);
    if(quiz.getAttribute("premium") != null && quiz.getAttribute("premium") === "true") $("#premium-checkbox").prop("checked", true);

    let questionNodes = [...questionsTag.childNodes];

    questionNodes.forEach(function(e) {
      if(e.tagName != null) {
        let block = addQuizQuestionBlock();
        loadBlockQuestionFromXML(block, e);
      }
    });
  }

function loadOptionsFromXML(optionsXMLFile) {
      let xmlOptions = new DOMParser().parseFromString(optionsXMLFile,"text/xml");

      let appName = xmlOptions.getElementsByTagName("app-name")[0];
      $("#app-name-input").val(appName.childNodes[0].nodeValue);

      $("#" + xmlOptions.getElementsByTagName("theme")[0].childNodes[0].nodeValue.replace("Menu","Theme")).prop("checked", true);

      $("#enable-theory-checkbox").prop("checked", xmlOptions.getElementsByTagName("enable-theory")[0].childNodes[0].nodeValue === "true");
      $("#enable-tests-checkbox").prop("checked", xmlOptions.getElementsByTagName("enable-tests")[0].childNodes[0].nodeValue === "true");
      $("#enable-support-checkbox").prop("checked", xmlOptions.getElementsByTagName("enable-support")[0].childNodes[0].nodeValue === "true");

      $("#enable-appname-checkbox").prop("checked", xmlOptions.getElementsByTagName("enable-appname")[0].childNodes[0].nodeValue === "true");
      $("#enable-tabs-checkbox").prop("checked", xmlOptions.getElementsByTagName("enable-tabs")[0].childNodes[0].nodeValue === "true");

      $("#enable-ads-checkbox").prop("checked", xmlOptions.getElementsByTagName("enable-ads")[0].childNodes[0].nodeValue === "true");

      $("#time-between-ads").val(xmlOptions.getElementsByTagName("time-between-ads")[0].childNodes[0].nodeValue);
}

function loadContentOfBlockFromXML(block, contentNode) {
  let select = block.find("select");

  if(contentNode.tagName === "h" || contentNode.tagName === "h1") loadHeadingFromXMLIntoBlock(contentNode, block, select);
  else if(contentNode.tagName === "p") loadTextFromXMLIntoBlock(contentNode, block, select);
  else if(contentNode.tagName === "img") loadImageFromXMLIntoBlock(contentNode, block, select);
  else if(contentNode.tagName === "button") loadButtonFromXMLIntoBlock(contentNode, block, select);
  else if(contentNode.tagName === "hr") select.val("Separator");

  select.change();
  $('select').niceSelect('update');
}

function loadHeadingFromXMLIntoBlock(contentNode, block, select) {
  select.val("Heading");
  if(contentNode.childNodes[0] != null) block.find(".heading-input").val(contentNode.childNodes[0].nodeValue);
}

function loadTextFromXMLIntoBlock(contentNode, block, select) {
  if(contentNode.getAttribute("type") === "quote") {
      select.val("Quote");
      block.find("textarea").css("font-style","italic");
  }
  else select.val("Paragraph");
  
  if(contentNode.childNodes[0] != null) {
    let text = contentNode.childNodes[0].nodeValue;
    text = text.replace(/(?:\\r\\n|\\r|\\n)/g, '\n');
    block.find("textarea").val(text);
  }
}

function loadImageFromXMLIntoBlock(contentNode, block, select) {
    select.val("Image");
    block.find(".image-link-input").val(contentNode.getAttribute("src"));
    block.find(".image-width-input").val(contentNode.getAttribute("width"));
    block.find(".invert-checkbox").prop("checked", contentNode.getAttribute("invert") === "true");

    loadImageThumbnail(block.find(".image-link-input"));
}

function loadButtonFromXMLIntoBlock(contentNode, block, select) {
    select.val("Button");
    if(contentNode.getAttribute("link") != null) {
      $("#radio-open-link-" + (blockCounter-1)).prop("checked", true);
      $("#radio-open-link-" + (blockCounter-1)).change();
      block.find(".button-action-input").val(contentNode.getAttribute("link"));
    }
    else if(contentNode.getAttribute("open-quiz") != null) {
      $("#radio-open-quiz-" + (blockCounter-1)).prop("checked", true);
      $("#radio-open-quiz-" + (blockCounter-1)).change();
      block.find(".button-action-input").val(contentNode.getAttribute("open-quiz"));
    }
    else if(contentNode.getAttribute("email") != null) {
      $("#radio-email-" + (blockCounter-1)).prop("checked", true);
      $("#radio-email-" + (blockCounter-1)).change();
      block.find(".button-action-input").val(contentNode.getAttribute("email"));
    }

    if(contentNode.getAttribute("theme") != null) block.find(".light-button-theme-checkbox").prop("checked", contentNode.getAttribute("theme") === "light");

    if(contentNode.childNodes[0] != null) block.find(".button-text-input").val(contentNode.childNodes[0].nodeValue);
}

function loadAboutInfoFromXMLToInputs(xml) {
  let title = xml.getElementsByTagName("title")[0].childNodes[0].nodeValue;
  let author = xml.getElementsByTagName("author")[0].childNodes[0].nodeValue;
  let themeName = xml.getAttribute("theme");

  $("#" + themeName).attr("checked", true);
  $("#title-input").val(title);
  $("#description-input").val(author);

  let icon = xml.getElementsByTagName("icon")[0].getAttribute("src");
  $("#icon-input").val(icon);
  loadIconThumbnail($("#icon-input"));
}

function loadBlockQuestionFromXML(block, questionNode) {
  try {
      block.find(".question-input").val(questionNode.getElementsByTagName("question")[0].childNodes[0].nodeValue);
  }
  catch {}

  try {
    block.find(".answer-input").val(questionNode.getElementsByTagName("answer")[0].childNodes[0].nodeValue);
  }
  catch {}

  try {
    block.find(".image-link-input").val(questionNode.getElementsByTagName("img")[0].getAttribute("src"));
    loadImageThumbnail(block.find(".image-link-input"));
  }
  catch {}

  let i = 0;

  let allOptions = questionNode.getElementsByTagName("option");
  for(i=0; i < allOptions.length; i++) {
      if(i > 3) {
          let quizOption = $("#quiz-option-template").clone();
          quizOption.removeAttr("id");
          quizOption.css("display","block");
          quizOption.find(".delete-option-button").click(function() {
              quizOption.remove();
          });
          block.find(".options-container").append(quizOption);
      }

      let optionCorrect = allOptions[i].getAttribute("correct") != null && allOptions[i].getAttribute("correct") === "true";
      try {
          block.find(".option-input:eq(" + i +")").val(allOptions[i].childNodes[0].nodeValue);
      }
      catch {}
      if(optionCorrect)  block.find(".option-correct:eq(" + i +")").prop("checked", true);
  }

  if(allOptions.length < 4) {
      for(let j = allOptions.length - 1; j < 4; j++) {
          block.find(".option-input:eq(" + i +")").closest(".quiz-option-container").remove();
      }
  }
}


  function loadChapterOrQuizInfoFromXMLToInputs(chapterAsXML) {
    let title = chapterAsXML.getElementsByTagName("title")[0].childNodes[0].nodeValue;
    let description = chapterAsXML.getElementsByTagName("description")[0].childNodes[0].nodeValue;
    let themeName = chapterAsXML.getAttribute("theme");

    $("#" + themeName).attr("checked", true);
    $("#title-input").val(title);
    $("#description-input").val(description);

    try {
        let icon = chapterAsXML.getElementsByTagName("icon")[0].getAttribute("src");
        $("#icon-input").val(icon);
        loadIconThumbnail($("#icon-input"));
    }
    catch { }
  }

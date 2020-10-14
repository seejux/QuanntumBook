let blockCounter = 1;
function addBlock() {
  let block = $("#block-template").clone();
  block.attr("id","block-" + blockCounter);
  block.css("display","block");
  block.appendTo("#block-container");

  $(".delete-block").click(function(){
    $(this).closest("li").remove();
  });

  let select = block.find("select");
  let idNum = blockCounter;

  select.attr("id","select-block-" + blockCounter);


  $(block.find(".radio-group input")[0]).prop("checked","true");

  block.find(".radio-group input").each(function() {
    $(this).attr("name", $(this).attr("name") + "-" + idNum);
    block.find("#" + $(this).attr("id") + "-label").attr("for", $(this).attr("id") + "-" + idNum);
    $(this).attr("id", $(this).attr("id") + "-" + idNum);
  });

  block.find("textarea").bind('input propertychange', function(e) {
     autoExpand(e.target);
  });

  block.find(".image-link-input").focusout(function() {
    loadImageThumbnail($(this));
  });

  block.find(".delete-chapter-image").click(function() {
      removeChapterImageThumbnail(block);
  });

  block.find(".add-icon-image").click(function() {
    showImagePicker($(this));
  });

  select.on('change', function() {
    changeBlockType(block, select);
  });

  $('#' + block.attr("id") + ' input[type=radio]').change(function() {
    if($(this).val() === "Open Link") block.find(".button-action-label").text("Link");
    else if($(this).val() === "Open Quiz") block.find(".button-action-label").text("Quiz Number");
    else if($(this).val() === "Email") block.find(".button-action-label").text("Email Address");
  });

  $('input, textarea').change(function () {
    window.onbeforeunload = () => {return '';}
  });

  blockCounter++;
  return block;
}

function addQuizQuestionBlock() {
    let block = $("#block-template").clone();
    block.attr("id","block-" + blockCounter);
    block.css("display","block");
    block.appendTo("#block-container");

    $(".delete-block").click(function(){
      $(this).closest("li").remove();
    });

    block.find(".delete-option-button").click(function() {
        $(this).closest(".quiz-option-container").remove();
    });

    block.find(".image-link-input").focusout(function() {
      loadImageThumbnail($(this));
    });

    block.find(".delete-chapter-image").click(function() {
        removeChapterImageThumbnail(block);
    });

    block.find(".add-icon-image").click(function() {
      showImagePicker($(this));
    });

    block.find(".add-option-button").click(function() {
        let quizOption = $("#quiz-option-template").clone();
        quizOption.removeAttr("id");
        quizOption.css("display","block");
        quizOption.find(".delete-option-button").click(function() {
            quizOption.remove();
        });
        block.find(".options-container").append(quizOption);

        $('input, textarea').change(function () {
          window.onbeforeunload = () => {return '';}
        });
   });

   $('input, textarea').change(function () {
    window.onbeforeunload = () => {return '';}
  });

   block.find("#question-image").attr("id", "question-image" + blockCounter);
   block.find(".question-image-label").attr("for", "question-image" + blockCounter);

   block.find("#question-input").attr("id", "question-input" + blockCounter);
   block.find(".question-input-label").attr("for", "question-input" + blockCounter);

   block.find("#answer-input").attr("id", "answer-input" + blockCounter);
   block.find(".answer-input-label").attr("for", "answer-input" + blockCounter);

   blockCounter++;
   return block;
}

function changeBlockType(block, select) {
    let blockInputHeading = block.find(".block-input-heading");
    let blockInputText = block.find(".block-input-text");
    let blockInputImage = block.find(".block-input-image");
    let blockInputButton = block.find(".block-input-button");

    blockInputHeading.css("display","none");
    blockInputText.css("display","none");
    blockInputImage.css("display","none");
    blockInputButton.css("display","none");

    let buttonRadioContainer = block.find(".button-radio-container");
    let value = select.val();

    if(value !== "Image") removeChapterImageThumbnail(block);

    if(value === "Paragraph" || value === "Quote" ) blockInputText.css("display","block");
    else if(value === "Button") blockInputButton.css("display","block");
    else if(value === "Image") blockInputImage.css("display","block");
    else if(value === "Heading") blockInputHeading.css("display","block");

    if(value === "Quote") blockInputText.find("textarea").css("font-style","italic");
    else blockInputText.find("textarea").css("font-style","normal");

    let blockNumber = block.attr("id").match(/\d+/g)[0];

    blockInputHeading.find("#chapter-heading").attr("id", "chapterHeading" + blockNumber);
    blockInputHeading.find("label").attr("for", "chapterHeading" + blockNumber);

    blockInputImage.find("#chapter-image").attr("id", "chapter-image" + blockNumber);
    blockInputImage.find("#chapter-image-width").attr("id", "chapter-image-width" + blockNumber);
    blockInputImage.find("#invert-checkbox").attr("id", "invert-checkbox" + blockNumber);

    blockInputImage.find(".chapter-image-label").attr("for", "chapter-image" + blockNumber);
    blockInputImage.find(".chapter-image-width-label").attr("for", "chapter-image-width" + blockNumber);
    blockInputImage.find(".invert-label").attr("for", "invert-checkbox" + blockNumber);

    blockInputButton.find("#chapter-button-action").attr("id", "chapter-button-action" + blockNumber);
    blockInputButton.find(".chapter-button-action-label").attr("for", "chapter-button-action" + blockNumber);

    blockInputButton.find("#chapter-button-text").attr("id", "chapter-text-action" + blockNumber);
    blockInputButton.find(".chapter-button-text-label").attr("for", "chapter-text-action" + blockNumber);

    blockInputButton.find("#light-theme-checkbox").attr("id", "light-theme-checkbox" + blockNumber);
    blockInputButton.find(".light-theme-checkbox-label").attr("for", "light-theme-checkbox" + blockNumber);

    blockInputText.find("#paragraph-input").attr("id", "paragraph-input" + blockNumber);
    blockInputText.find(".paragraph-input-label").attr("for", "paragraph-input" + blockNumber);
}

function loadIconThumbnail(iconLinkInput) {
    if(iconLinkInput.val().length < 1) return;
    chapterIconLink = iconLinkInput.val();
    $("#icon-image").attr("src",chapterIconLink.replace("/media-uploader/","/thumbnail-uploader/"));
    $("#icon-input-container").css("display","none");
    $("#chapter-icon-container").css("display","block");
    $("#icon-image-text").text(chapterIconLink);
    $("#icon-error-label").text("");
}

function removeChapterIconThumbnail() {
    $("#icon-input-container").css("display","block");
    $("#chapter-icon-container").css("display","none");
    $("#icon-image").attr("src","");
}

function loadImageThumbnail(imageLinkInput) {
    if(imageLinkInput.val().length < 1) return;

    let block = imageLinkInput.closest(".block");
    block.find(".thumbnail-image").attr("src", imageLinkInput.val().replace("/media-uploader/","/thumbnail-uploader/"));
    block.find(".image-link-input-container").css("display","none");
    block.find(".chapter-image-container").css("display","block");
    block.find(".chapter-image-title").text(imageLinkInput.val());
}

function removeChapterImageThumbnail(block) {
    block.find(".image-link-input-container").css("display","block");
    block.find(".chapter-image-container").css("display","none");
    block.find(".thumbnail-image").attr("src","");
}

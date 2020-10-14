function requestXMLFile(filePath) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', filePath, false);
    xhr.onreadystatechange = function () {
      if(xhr.readyState === 4 && (xhr.status === 200 || xhr.status == 0)) {
          onXMLFileReceived(xhr.responseText);
      }
    };
    xhr.send();
}

let itemCounter = 0;
function createChapter(title, type, chapterNumber, subChapterNumber, hasSubchapters) {
    itemCounter++;
    let new_chapter = $("#chapter-template-0").clone();
    // modify the id
    new_chapter.css("display","table-row");
    new_chapter.attr("id","chapter-"+itemCounter);

    new_chapter.find(".chapter-title").text(title);
    if(type != null) new_chapter.find('.chapter-type').text(type);
    if(hasSubchapters) new_chapter.find(".edit-chapter-link").attr("href","/edit-two-level-chapter/" + chapterNumber);
    else {
        if(subChapterNumber == 0) new_chapter.find(".edit-chapter-link").attr("href","/edit-chapter/" + chapterNumber);
        else new_chapter.find(".edit-chapter-link").attr("href","/edit-chapter/" + chapterNumber + "/" + subChapterNumber);
    }

    new_chapter.find("input").addClass("select-chapter");

    // add to the table
    new_chapter.appendTo("#chapters-table-body");

    new_chapter.find(".select-chapter").each(function(){
        $(this).change(function(){
            checkboxClicked($(this));
        });
    });
}

function createQuiz(title, numberOfQuestions, quizNumber) {
    itemCounter++;
    let new_quiz = $("#chapter-template-0").clone();
    // modify the id
    new_quiz.css("display","table-row");
    new_quiz.attr("id","quiz-"+itemCounter);

    new_quiz.find('.number-of-questions').text(numberOfQuestions);

    new_quiz.find(".quiz-title").text(title);
    new_quiz.find(".edit-chapter-link").attr("href","/edit-quiz/" + quizNumber);
    new_quiz.find("input").addClass("select-quiz");

    // add to the table
    new_quiz.appendTo("#quizzes-table-body");

    new_quiz.find(".select-quiz").each(function(){
        $(this).change(function(){
            checkboxClicked($(this));
        });
    });
}

let numberOfClicked = 0;

function checkboxClicked(checkBox) {
    if(!checkBox.prop("checked")) {
        numberOfClicked -= 1;
        if(numberOfClicked < 1) $("#deleteItem").attr('disabled',true);
        $('#selectAll').prop("checked", false);
    }
    else {
        numberOfClicked += 1;
        $("#deleteItem").attr('disabled',false);
    }
}

function showModal(modalHeading, modalText) {
    $("#modal").find("header").text(modalHeading);
    $("#modal").find("article").text(modalText);
    // show modal
    $("#modal").fadeIn().css("display","block");
}

let numOfRemoved = 0;
function deleteChapter(chapterNumber, parentChapterNumber, chaptersXMLFile) {
    let xmlChapters = new DOMParser().parseFromString(chaptersXMLFile,"text/xml").getElementsByTagName("chapters")[0];

    if(parentChapterNumber > 0) {
        let parentSubchaptersTag = xmlChapters.getElementsByTagName("chapter")[parentChapterNumber - 1].getElementsByTagName("subchapters")[0];
        let chapter = parentSubchaptersTag.getElementsByTagName("subchapter")[chapterNumber - 1 - numOfRemoved];
        parentSubchaptersTag.removeChild(chapter);
    }
    else {
        let chapter = xmlChapters.getElementsByTagName("chapter")[chapterNumber - 1 - numOfRemoved];
        if(chapter == null) return;
        xmlChapters.removeChild(chapter);
    }

    chaptersXMLFile = (new XMLSerializer()).serializeToString(xmlChapters);
    numOfRemoved++;

    return chaptersXMLFile;
}

function deleteQuiz(quizNumber, quizzesXMLFile) {
    let xmlQuizzes = new DOMParser().parseFromString(quizzesXMLFile,"text/xml").getElementsByTagName("quizzes")[0];

    let quiz = xmlQuizzes.getElementsByTagName("quiz")[quizNumber - 1 - numOfRemoved];
    if(quiz == null) return;
    xmlQuizzes.removeChild(quiz);

    quizzesXMLFile = (new XMLSerializer()).serializeToString(xmlQuizzes);
    numOfRemoved++;

    return quizzesXMLFile;
}

function parseChapterTitles(xmlFile) {
    let parser = new DOMParser();
    let xmlChapters = parser.parseFromString(xmlFile,"text/xml");

    let chapters = xmlChapters.getElementsByTagName("chapter");
    let i;
    for (i = 0; i < chapters.length; i++) {
        let chapterTitle = chapters[i].getElementsByTagName("title")[0].childNodes[0].nodeValue;
        let subchaptersTag = chapters[i].getElementsByTagName("subchapters");

        if(subchaptersTag.length > 0) createChapter(chapterTitle, "Two Level Chapter", i + 1, 0, true);
        else createChapter(chapterTitle, "One Level Chapter", i + 1, 0, false);
    }
    i++;
    $("#new-chapter-button").attr("href","/edit-chapter/" + i);
    $("#new-two-level-chapter-button").attr("href","/edit-two-level-chapter/" + i);
}

function parseSubchapterTitles(chapterNumber, xmlFile) {
    let parser = new DOMParser();
    let xmlChapters = parser.parseFromString(xmlFile,"text/xml");

    let parentChapter = xmlChapters.getElementsByTagName("chapter")[chapterNumber - 1];
    if(parentChapter == null) return;

    let childChapters = parentChapter.getElementsByTagName("subchapter");

    let i;
    for (i = 0; i < childChapters.length; i++) {
        let chapterTitle = childChapters[i].getElementsByTagName("title")[0].childNodes[0].nodeValue;
        createChapter(chapterTitle, null, chapterNumber, i + 1, false);
    }
    i++;
}

function parseQuizTitles(xmlFile) {
    let xmlQuizzes = new DOMParser().parseFromString(xmlFile,"text/xml");

    let quizzes = xmlQuizzes.getElementsByTagName("quiz");
    let i;
    for (i = 0; i < quizzes.length; i++) {
        let quizTitle = quizzes[i].getElementsByTagName("title")[0].childNodes[0].nodeValue;
        let numberOfQuestions = quizzes[i].getElementsByTagName("question").length;
        createQuiz(quizTitle, numberOfQuestions,  i + 1);
    }
    i++;
    $("#new-quiz-button").attr("href","/edit-quiz/" + i);
}


function autoExpand(field) {
    // Reset field height
    field.style.height = 'inherit';

    // Get the computed styles for the element
    var computed = window.getComputedStyle(field);

    // Calculate the height
    var height = parseInt(computed.getPropertyValue('border-top-width'), 10)
                   + parseInt(computed.getPropertyValue('padding-top'), 10)
                   + field.scrollHeight
                   + parseInt(computed.getPropertyValue('padding-bottom'), 10)
                   + parseInt(computed.getPropertyValue('border-bottom-width'), 10);

      field.style.height = height + 'px';
}

function submitChapterXML(chapterNumber, subChapterNumber, isTwoLevel, chaptersXMLFile, afterSavedRedirectionURL) {
    let xmlAsString = (new XMLSerializer()).serializeToString(convertChapterToXML(chapterNumber, subChapterNumber, isTwoLevel, chaptersXMLFile));
    $("#xmlFileInput").val(html_beautify(xmlAsString));
    $('#xmlFileInput').append('<input type="hidden" name="chapterNumber" value="' + chapterNumber + '" />');
    $('#xmlFileInput').append('<input type="hidden" name="subChapterNumber" value="' + subChapterNumber + '" />');
    $('#xmlFileInput').append('<input type="hidden" name="redirectionURL" value="' + afterSavedRedirectionURL + '" />');
    $("#postChapterForm").submit();
}

function submitQuizXML(quizNumber, quizzesXMLFile) {
    let xmlAsString = (new XMLSerializer()).serializeToString(convertQuizToXML(quizNumber, quizzesXMLFile));
    $("#xmlFileInput").val(html_beautify(xmlAsString));
    $('#xmlFileInput').append('<input type="hidden" name="chapterNumber" value="' + quizNumber + '" />');
    $("#postQuizForm").submit();
}

$(document).on("keydown", "form", function(event) {
 return event.key != "Enter";
});

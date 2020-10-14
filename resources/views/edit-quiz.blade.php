@extends('layouts.app')
@section('content')
<div class="main-content">
   <div class="backdrop--1NPZgaTLwy" role="button"></div>
   <main class="main">
   <header class="header--2MTvIGNc3d">
      <nav class="toolbar--2aA3VIsptd light--oIqXlbEbXx">
         <div class="controls--2YAMXys21b grow--2KB1wtNeK3">
            <div class="items-container--3v79arC6i5">
               <ul class="items--2UaqaDVVnV light--ZAKOwIF2HH">
                  <li>
                     <div class="dropdown">
                        <button class="button--Fry28Tt4id light--3tjxVCiYyF" id="save-button">
                        <span aria-label="fas fa-save" class="fas fa-save top-bar-icon"></span><span class="top-button-label">Save</span>
                        </button>
                     </div>
                  </li>
                  <!-- DELETE -->
                  <li>
                     <button id="deleteQuiz" class="button--Fry28Tt4id light--3tjxVCiYyF" disabled>
                     <span aria-label="fas fa-trash-alt" class="fas fa-trash-alt top-bar-icon"></span>
                     <span class="top-button-label">Delete</span>
                     </button>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
   </header>
   <div class="view-container-3">
      <div class="new-chapter-form">
         <div class="grid--370cPalb_8 grid--3IQZeqSYws">
            <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
               <label class="section-label" for="themes">Quiz Theme *</label>
               <div class="field themes" id="themes">
                  <input style="background-color: #6fb181" id="Theme1" name="theme" type="radio" value="" >
                  <input style="background-color: #ca494a" id="Theme2" name="theme" type="radio" value="">
                  <input style="background-color: #b17861" id="Theme3" name="theme" type="radio" value="">
                  <input style="background-color: #b9b64d" id="Theme4" name="theme" type="radio" value="">
                  <input style="background-color: #887396" id="Theme5" name="theme" type="radio" value="">
                  <input style="background-color: #6e2f3e" id="Theme6" name="theme" type="radio" value="">
                  <input style="background-color: #36a193" id="Theme7" name="theme" type="radio" value="">
                  <input style="background-color: #88b483" id="Theme8" name="theme" type="radio" value="">
                  <input style="background-color: #d29f45" id="Theme9" name="theme" type="radio" value="">
                  <input style="background-color: #6a91ba" id="Theme10" name="theme" type="radio" value="">
                  <input style="background-color: #4b468e" id="Theme11" name="theme" type="radio" value="">
                  <input style="background-color: #76517c" id="Theme12" name="theme" type="radio" value="">
                  <input style="background-color: #567c64" id="Theme13" name="theme" type="radio" value="">
                  <input style="background-color: #87616f" id="Theme14" name="theme" type="radio" value="">
                  <input style="background-color: #964a4e" id="Theme15" name="theme" type="radio" value="">
                  <input style="background-color: #81c6af" id="Theme16" name="theme" type="radio" value="">
                  <input style="background-color: #61a1ae" id="Theme17" name="theme" type="radio" value="">
                  <input style="background-color: #455683" id="Theme18" name="theme" type="radio" value="">
               </div>
               <label class="error-label" id="theme-error-label"></label>
            </div>
            <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
               <div class="field">
                  <label class="section-label" for="title-input">Quiz Title *</label>
                  <div class="field">
                     <label class="input left--3McDXiCrys headline"><input id="title-input" type="text" value="" /></label>
                  </div>
                  <label class="error-label" id="title-error-label"></label>
               </div>
            </div>
            <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
               <div class="field">
                  <label class="section-label" for="description-input">Quiz Description *</label>
                  <div class="field-container">
                     <div class="field">
                        <label class="input left--3McDXiCrys headline"><input id="description-input" type="text" value="" style="font-size: 15px"/></label>
                     </div>
                  </div>
                  <label class="error-label" id="description-error-label"></label>
               </div>
            </div>
            <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
               <div class="field">
                  <label class="section-label">Options</label>
                  <div class="field-container">
                     <div class="field" style="display: flex">
                        <input type="checkbox" id="shuffle-questions-checkbox" style="height: 25px">
                        <label class="section-label" for="shuffle-questions-checkbox">Shuffle Questions</label>
                        <a href="#fn:shuffleQuestions" rel="footnote"></a>
                     </div>
                  </div>
                  <div class="field-container">
                     <div class="field" style="display: flex">
                        <input type="checkbox" id="premium-checkbox" style="height: 25px">
                        <label class="section-label" for="premium-checkbox">Premium Quiz</label>
                        <a href="#fn:premiumQuiz" rel="footnote"></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
               <div class="field">
                  <label class="section-label" for="/blocks">Questions</label>
                  <div class="field-container">
                     <div class="field" id="block-container">
                     </div>
                     <button id="add-block" class="button--319u6U1AIl add-button" type="button"><i class="fas fa-plus button-icon--2zwDFL5-yo"></i><span class="text--3HNWf-tIc7">Add Question</span></button></section>
                  </div>
                  <label class="error-label"></label>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<li id="block-template" style="display: none">
   <div class="block expanded">
      <div class="handle"><i class="fas fa-ellipsis-v" aria-hidden="true"></i></div>
      <div class="content--Q--ddExW3x">
         <header class="selector-container">
            <div class="icons--3gZEnEY5xT">
               <span class="fas fa-trash-alt clickable delete-block" role="button" tabindex="0"></span>
            </div>
         </header>
         <div class="block-input">
            <div class="block-input-heading" style="margin-bottom: 15px">
               <label for="question-input" class="section-label question-input-label" style="display: block">Question *</label>
               <div class="input left--3McDXiCrys headline" style="margin-bottom: 15px; align-items: center;"><input id="question-input" class="question-input" type="text" value="" style="font-size: 15px"/></div>
            </div>
            <div class="block-input-image image-input-container" style=" margin-bottom: 15px">
               <label for="question-image" class="section-label question-image-label" style="display: block">Question Image Link</label>
               <div class="image-link-input-container">
                  <div class="input left--3McDXiCrys headline" style="margin-bottom: 15px; align-items: center;">
                     <button class="image-picker-button left--1FyHE23CXB add-icon-image" type="button"><span aria-label="fas fa-image" class="fas fa-image icon--zG2a3XJIeF"></span></button>
                     <input id="question-image" type="text" class="image-link-input" value="" style="font-size: 15px"/>
                  </div>
               </div>
               <div class="chapter-image-container" style="display: none; margin-bottom: 30px">
                  <div class="multi-input-container">
                     <button class="image-picker-button left--1FyHE23CXB add-icon-image" type="button"><span aria-label="fas fa-image" class="fas fa-image icon--zG2a3XJIeF"></span></button>
                     <div class="item--91fU1JyQEP">
                        <div class="media-item--39GrC_T1V3">
                           <img class="thumbnail-image" src="" id="icon-image">
                           <div class="thumbnail-image-title chapter-image-title"></div>
                        </div>
                     </div>
                     <span class="fas fa-trash-alt clickable delete-chapter-image" role="button" tabindex="0" style="margin-right: 8px"></span>
                  </div>
               </div>
            </div>
            <div class="block-input-heading" style="margin-bottom: 15px">
               <label for="answer-input" class="section-label answer-input-label" style="display: block">Correct Answer Explanation *</label>
               <div class="input left--3McDXiCrys headline" style="margin-bottom: 15px; align-items: center;">
                  <input id="answer-input" class="answer-input" type="text" value="" style="font-size: 15px"/>
               </div>
            </div>
            <label class="section-label" style="display: block">Options (check all correct options) *</label>
            <div class="options-container">
               <div class="quiz-option-container" style="display: block; margin-bottom: 10px;">
                  <div class="multi-input-container">
                     <input type="checkbox" class="option-correct">
                     <div class="input headline" style="margin-bottom: 15px; align-items: center; border: none; height: 38px; margin-bottom: 0"><input class="option-input" type="text" value="" style="font-size: 15px"/>
                        <span class="fas fa-trash-alt clickable delete-option-button" role="button" tabindex="0" style="margin-right: 8px"></span>
                     </div>
                  </div>
               </div>
               <div class="quiz-option-container" style="display: block; margin-bottom: 10px;">
                  <div class="multi-input-container">
                     <input type="checkbox" class="option-correct">
                     <div class="input headline" style="margin-bottom: 15px; align-items: center; border: none; height: 38px; margin-bottom: 0"><input class="option-input" type="text" value="" style="font-size: 15px"/>
                        <span class="fas fa-trash-alt clickable delete-option-button" role="button" tabindex="0" style="margin-right: 8px"></span>
                     </div>
                  </div>
               </div>
               <div class="quiz-option-container" style="display: block; margin-bottom: 10px;">
                  <div class="multi-input-container">
                     <input type="checkbox" class="option-correct">
                     <div class="input headline" style="margin-bottom: 15px; align-items: center; border: none; height: 38px; margin-bottom: 0">
                        <input class="option-input" type="text" value="" style="font-size: 15px"/>
                        <span class="fas fa-trash-alt clickable delete-option-button" role="button" tabindex="0" style="margin-right: 8px"></span>
                     </div>
                  </div>
               </div>
               <div class="quiz-option-container" style="display: block; margin-bottom: 10px;">
                  <div class="multi-input-container">
                     <input type="checkbox" class="option-correct">
                     <div class="input headline" style="margin-bottom: 15px; align-items: center; border: none; height: 38px; margin-bottom: 0"><input class="option-input" type="text" value="" style="font-size: 15px"/>
                        <span class="fas fa-trash-alt clickable delete-option-button" role="button" tabindex="0" style="margin-right: 8px"></span>
                     </div>
                  </div>
               </div>
            </div>
            <div style="text-align:center; width: 100%">
               <button class="add-option-button button--319u6U1AIl add-button" type="button"><i class="fas fa-plus button-icon--2zwDFL5-yo"></i><span class="text--3HNWf-tIc7">Add Option</span></button>
            </div>
         </div>
      </div>
   </div>
</li>
<form action="/save-quiz" method="POST" enctype="multipart/form-data" style="display: none" id="postQuizForm">
   {{csrf_field()}}
   <input type="text" name="text" id="xmlFileInput">
   <input type="submit">
</form>
<div class="chapter-image-container quiz-option-container" style="display: none; margin-bottom: 10px;" id="quiz-option-template">
   <div class="multi-input-container">
      <input type="checkbox" class="option-correct">
      <div class="input headline" style="margin-bottom: 15px; align-items: center; border: none; height: 38px; margin-bottom: 0">
         <input class="option-input" type="text" value="" style="font-size: 15px"/>
         <span class="fas fa-trash-alt clickable delete-option-button" role="button" tabindex="0" style="margin-right: 8px"></span>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
     requestXMLFile("/xml/quizzes.xml");

     $('#postQuizForm').submit(function () {
         window.onbeforeunload = null;
     });

     $('select').niceSelect();

     $('#block-container').sortable({
       handle: '.handle',
       animation: 150
     });

     $("#add-block").click(function() {
       addQuizQuestionBlock();
     });

     $("#description-input").change(function() {
       $("#description-error-label").text("");
     });

     $("#title-input").change(function() {
       $("#title-error-label").text("");
     });

     $("#deleteQuiz").click(function(e){
         showModal("Delete?","This operation will delete the quiz and cannot be undone. Do you wish to proceed?");
     });

     $('#cancel').click(function(e){
       $("#modal").css("display","none");
     });

     $('#forward-button').click(function() {
       goForward('#forward-button','#backward-button');
     });

     $('#backward-button').click(function() {
       goBackward('#forward-button','#backward-button');
     });

     scrollOnOpenSelect('.itemsPerPage-select', ".content--1lT7Ozsit1", ".dialog--RUeFRUqJ7i", 1);
   });

   function onXMLFileReceived(xmlFile) {
   loadQuizFromXML({{ $quizNumber }}, xmlFile);

   $("#save-button").click(function() {
     submitQuizXML({{ $quizNumber }}, xmlFile);
   });

   $('#ok').click(function(e){
       xmlFile = deleteQuiz({{ $quizNumber }}, xmlFile);
       $("#xmlFileInput").val(html_beautify(xmlFile));
       $("#postQuizForm").submit();
   });
   }

</script>
@endsection

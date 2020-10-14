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
               <li>
                  <button id="deleteParentChapter" class="button--Fry28Tt4id light--3tjxVCiYyF" disabled>
                    <span aria-label="fas fa-trash-alt" class="fas fa-trash-alt top-bar-icon"></span>
                    <span class="top-button-label">Delete</span>
                  </button>
               </li>
               <li>
                  <button class="button--Fry28Tt4id light--3tjxVCiYyF add-1-Chapter" id="new-chapter-button">
                  <span aria-label="fas fa-plus" class="fas fa-plus top-bar-icon"></span>
                  <span class="top-button-label">Add New Subchapter</span>
                  </button>
               </li>
               <li>
                  <button id="deleteItem" class="button--Fry28Tt4id light--3tjxVCiYyF" disabled=""><span aria-label="fas fa-trash-alt" class="fas fa-trash-alt top-bar-icon"></span><span class="top-button-label">Delete Subchapter</span></button>
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
            <label class="section-label" for="themes">Chapter Theme *</label>
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
               <label class="section-label" for="title-input">Chapter Title *</label>
               <div class="field">
                  <label class="input left--3McDXiCrys headline"><input id="title-input" type="text" value="" /></label>
               </div>
               <label class="error-label" id="title-error-label"></label>
            </div>
         </div>
         <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
            <div class="field">
               <label class="section-label" for="description-input">Chapter Description *</label>
               <div class="field-container">
                  <div class="field">
                     <label class="input left--3McDXiCrys headline"><input id="description-input" type="text" value="" style="font-size: 15px"/></label>
                  </div>
               </div>
               <label class="error-label" id="description-error-label"></label>
            </div>
         </div>
         <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL image-input-container">
            <div class="field">
               <label class="section-label" for="icon-input">Chapter Icon Link *</label>
               <div class="field-container" id="icon-input-container">
                  <div class="field">
                     <label class="input left--3McDXiCrys headline" for="icon-input">
                     <button class="image-picker-button left--1FyHE23CXB add-icon-image" type="button"><span aria-label="fas fa-image" class="fas fa-image icon--zG2a3XJIeF"></span></button>
                     <input id="icon-input" class="image-link-input" type="text" value="" style="font-size: 15px">
                     </label>
                  </div>
               </div>
               <div id="chapter-icon-container" class="chapter-image-container" style="display: none; margin-bottom: 10px;">
                  <div class="multi-input-container" style="padding-left: 0">
                     <button class="image-picker-button left--1FyHE23CXB add-icon-image" type="button"><span aria-label="fas fa-image" class="fas fa-image icon--zG2a3XJIeF"></span></button>
                     <div class="item--91fU1JyQEP" style="padding-left: 10px">
                        <div class="media-item--39GrC_T1V3">
                           <img class="thumbnail-image" src="" id="icon-image">
                           <div class="thumbnail-image-title" id="icon-image-text"></div>
                        </div>
                     </div>
                     <span class="fas fa-trash-alt clickable" role="button" tabindex="0" style="margin-right: 8px" id="delete-chapter-icon"></span>
                  </div>
               </div>
               <label class="error-label" id="icon-error-label"></label>
            </div>
         </div>
         @if($chapterNumber != 0)
           <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
              <div class="field">
                 <label class="section-label">Options</label>
                 <div class="field-container">
                    <div class="field" style="display: flex">
                       <input type="checkbox" id="premium-checkbox" style="height: 25px">
                       <label class="section-label" for="premium-checkbox">Premium Chapter</label>
                       <a href="#fn:premiumChapter" rel="footnote"></a>
                    </div>
                 </div>
              </div>
           </div>
         @endif
         <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
            <div class="field">
               <label class="section-label" for="/blocks">Subchapters</label>
            </div>
         </div>
      </div>
      <div class="dark--3w5GzWBb9F">
         <table class="table--3OVMF8dOBt">
            <thead class="header--18fHWvcEtu">
               <tr>
                  <th class="header-button-cell--2jMdDWPow1 header-cell">
                     <span><span aria-label="fas fa-pen" class="fas fa-pen"></span></span>
                  </th>
                  <!-- SELECT ALL -->
                  <th class="header-cell">
                     <span>
                     <label class="label--22nuJrNdMC">
                     <span class="switch--52fMu6kGAZ checkbox--2Z3YMYLqUa light--29kb21gbll"><input id="selectAll" type="checkbox" value="" /><span></span></span>
                     </label>
                     </span>
                  </th>
                  <th class="header-cell clickable--lc4pQQLkgC">
                     <p>Subchapter Name</p>
                  </th>
               </tr>
            </thead>
            <tbody id="chapters-table-body">
               <!-- CHAPTER TEMPLATE -->
               <tr class="row--16jZlysVSE chapter" id="chapter-template-0" style="display:none;">
                  <td class="button-cell--15ZsRHax0E cell--3QhdjYDo1X">
                     <div class="cell-content">
                        <a href=# class="edit-chapter-link">
                        <button><span aria-label="fas fa-pen" class="fas fa-pen"></span></button>
                        </a>
                     </div>
                  </td>
                  <td class="cell--3QhdjYDo1X small--1KOK57-GZT">
                     <div class="cell-content">
                        <label class="label--22nuJrNdMC">
                        <span class="switch--52fMu6kGAZ checkbox--2Z3YMYLqUa dark--1gdZ2dJMIJ"><input type="checkbox" value="e7c752ce-0da6-4eb5-9f29-80009c5154f5" /><span></span></span>
                        </label>
                     </div>
                  </td>
                  <td class="cell--3QhdjYDo1X">
                     <div class="cell-content chapter-title"></div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</div>
<li id="block-template" style="display: none">
   <div class="block expanded" >
   <div class="handle">
      <i class="fas fa-ellipsis-v" aria-hidden="true"></i>
      <div class="content--Q--ddExW3x" >
         <header class="selector-container">
            <div class="types--3BMYLuVPAf">
               <div class="select--2Y_GcUrdzb">
                  <select class="ignore select-block" id="select-block-1">
                     <option value="Heading">Heading</option>
                     <option value="Paragraph">Paragraph</option>
                     <option value="Quote">Quote</option>
                     <option value="Image">Image</option>
                     <option value="Button">Button</option>
                     <option value="Separator">Separator</option>
                  </select>
               </div>
            </div>
            <div class="icons--3gZEnEY5xT">
               <span class="fas fa-trash-alt clickable delete-block" role="button" tabindex="0"></span>
               <span aria-label="su-angle-down" class="fas fa-angle-up clickable"></span>
            </div>
         </header>
         <br>
         <div class="block-input">
            <div class="block-input-heading">
               <label for="chapter-heading" class="section-label" style="display: block">Text</label>
               <div class="input left--3McDXiCrys headline" style="margin-bottom: 15px; align-items: center;"><input id="chapter-heading" class="heading-input" type="text" value="" /></div>
            </div>
            <div class="field block-input-text" style="display: none; margin-bottom: 15px">
               <label for="button-radio-group" class="section-label">Text</label>
               <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr" lang="en" aria-labelledby="ck-editor__aria-label_ecef60e79a8e492826fcde840adaa8a28">
                  <textarea class="ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline ck-blurred" style="font-family: Lato; width: 100%; resize: none"></textarea>
               </div>
            </div>
            <div class="block-input-image image-input-container" style="display: none; margin-bottom: 15px">
               <label for="chapter-image" class="section-label" style="display: block">Image Link</label>
               <div class="image-link-input-container">
                  <div class="input left--3McDXiCrys headline" style="margin-bottom: 15px; align-items: center;">
                     <button class="image-picker-button left--1FyHE23CXB add-icon-image" type="button"><span aria-label="fas fa-image" class="fas fa-image icon--zG2a3XJIeF"></span></button>
                     <input id="chapter-image" type="text" class="image-link-input" value="" style="font-size: 15px"/>
                  </div>
               </div>
               <div class="chapter-image-container" style="display: none; margin-bottom: 15px">
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
               <label for="chapter-image-width" class="section-label" style="display: block">Image Width</label>
               <div class="input left--3McDXiCrys" style="margin-bottom: 15px; align-items: center; width: 80px; height: 40px"><input id="chapter-image-width" class="image-width-input" type="number" value="" min="0"/></div>
            </div>
            <div class="block-input-button" style="display: none; margin-bottom: 15px">
               <span class="button-radio-container">
                  <label for="button-radio-group" class="section-label">Choose action</label>
                  <div>
                     <div class="radio-group" id="button-radio-group">
                        <input type="radio" name="button-action" id="radio-open-link" checked="" value="Open Link"><label id="radio-open-link-label" for="radio-open-link" class="label">Open Link</label>
                        <input type="radio" name="button-action" id="radio-open-quiz" value="Open Quiz"><label id="radio-open-quiz-label" for="radio-open-quiz" class="label">Open Quiz</label>
                        <input type="radio" name="button-action" id="radio-email" value="Email"><label id="radio-email-label" for="radio-email" class="label">Email</label>
                     </div>
                  </div>
               </span>
               <label class="button-action-label section-label" for="chapter-image" style="display: block">Link</label>
               <div id="chapter-image" class="input left--3McDXiCrys headline" style="margin-bottom: 15px; align-items: center;">
                  <input id="chapter-button-action" class="button-action-input" type="text" value="" style="font-size: 15px"/>
               </div>
               <label for="chapter-image-width" class="section-label" style="display: block">Button Text</label>
               <div id="chapter-image-width" class="input left--3McDXiCrys headline" style="margin-bottom: 15px; align-items: center;">
                  <input id="chapter-button-text" class="button-text-input" type="text" value="" style="font-size: 15px"/>
               </div>
            </div>
         </div>
      </div>
   </div>
</li>
<form action="/edit-chapter/{{$chapterNumber}}" method="POST" enctype="multipart/form-data" style="display: none" id="postChapterForm">
   {{csrf_field()}}
   <input type="text" name="text" id="xmlFileInput">
   <input type="submit">
</form>

<script>
   let numberOfImages;

   $(document).ready(function() {
     requestXMLFile("/xml/chapters.xml");

     $('select').niceSelect();

     numberOfImages = $(".media-listView").length;
     setNumberOfPages(numberOfImages);

     $('#block-container').sortable({
       handle: '.handle',
       animation: 150
     });

     $("#add-block").click(function() {
       addBlock();
     });

     $("#description-input").change(function() {
       $("#description-error-label").text("");
     });

     $("#title-input").change(function() {
       $("#title-error-label").text("");
     });

     $("#icon-input").focusout(function() {
         loadIconThumbnail($(this));
     });

     $("#delete-chapter-icon").click(function() {
       removeChapterIconThumbnail();
     });


     // new
     $('#forward-button').click(function() {
       goForward('#forward-button','#backward-button');
     });

     // new
     $('#backward-button').click(function() {
       goBackward('#forward-button','#backward-button');
     });

     // new
     scrollOnOpenSelect('.itemsPerPage-select', ".content--1lT7Ozsit1", ".dialog--RUeFRUqJ7i", 1);
   });

   $(document).ready(function() {
   $('#postChapterForm').submit(function () {
   window.onbeforeunload = null;
   });

   $('#selectAll').change(function() {
   if($(this).prop('checked')) {
     $('.select-chapter').each(function() {
     if(!$(this).prop("checked")) {
         $(this).prop('checked', true);
         numberOfClicked += 1;
     }
     })
     $("#deleteItem").attr('disabled',false);
   }
   else {
     $('.select-chapter').prop('checked', false);
     $("#deleteItem").attr('disabled',true);
     numberOfClicked = 0;
   }
   });
   });

   function onXMLFileReceived(xmlFile) {
   loadChapterFromXML({{ $chapterNumber }}, 0, xmlFile);
   parseSubchapterTitles({{ $chapterNumber }}, xmlFile);

   $("#save-button").click(function() {
     submitChapterXML({{ $chapterNumber }}, 0, true, xmlFile);
   });


  $("#new-chapter-button").click(function() {
    let nextSubchapterNumber = $("#chapters-table-body tr").length;
    submitChapterXML({{ $chapterNumber }}, 0, true, xmlFile, "/edit-chapter/" + {{ $chapterNumber }} + "/" + nextSubchapterNumber);
  });

   $("#deleteItem").click(function(e){
       showModal("Delete?","This operation will delete selected subchapters and cannot be undone. Do you wish to proceed?");

       $('#cancel').click(function(e){
         $("#modal").css("display","none");
       });

       $('#ok').off();
       $('#ok').click(function(e){
         $('#selectAll').prop('checked',false);

         // delete chapters
         $('#chapters-table-body').find(".select-chapter").each(function(e){
             if($(this).prop('checked')){
               let parentChapter = $(this).closest(".chapter");
               let id = parentChapter.attr("id");
               let idNum = id.substring(id.lastIndexOf("-")+1);
               parentChapter.remove();

               xmlFile = deleteChapter(idNum, {{ $chapterNumber }}, xmlFile);
               numberOfClicked-=1;
             }
         });
         if(numberOfClicked < 1) $("#deleteItem").attr('disabled',true);

         $("#modal").fadeOut("slow").css("display","none");

         $("#xmlFileInput").val(html_beautify(xmlFile));
         $('#xmlFileInput').append('<input type="hidden" name="chapterNumber" value="' + {{ $chapterNumber }} + '" />');
         $('#xmlFileInput').append('<input type="hidden" name="subChapterNumber" value="1"/>');
         $("#postChapterForm").submit();
       });
   });

   $("#deleteParentChapter").click(function(e){
       showModal("Delete?", "This operation will delete the chapter and all its subchapters and cannot be undone. Do you wish to proceed?");

       $('#cancel').click(function(e){
         $("#modal").css("display","none");
       });

       $('#ok').off();
       $('#ok').click(function(e){
         xmlFile = deleteChapter({{ $chapterNumber }}, 0, xmlFile);

         $("#xmlFileInput").val(html_beautify(xmlFile));
         $('#xmlFileInput').append('<input type="hidden" name="chapterNumber" value="' + {{ $chapterNumber }} + '" />');
         $('#xmlFileInput').append('<input type="hidden" name="subChapterNumber" value="0"/>');
         $("#postChapterForm").submit();
       });
   });
   }
</script>
@endsection

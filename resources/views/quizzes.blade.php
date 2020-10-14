@extends('layouts.app')
@section('content')
<div class="main-content">
   <main class="main">
      <header class="header--2MTvIGNc3d">
         <nav class="toolbar--2aA3VIsptd light--oIqXlbEbXx">
            <div class="controls--2YAMXys21b grow--2KB1wtNeK3">
               <div class="items-container--3v79arC6i5">
                  <ul class="items--2UaqaDVVnV light--ZAKOwIF2HH">
                     <!-- ONE LEVEL CHAPTER -->
                     <li>
                        <a href="#" style="text-decoration: none" id="new-quiz-button">
                        <button class="button--Fry28Tt4id light--3tjxVCiYyF add-1-Chapter">
                        <span aria-label="fas fa-plus" class="fas fa-plus top-bar-icon"></span>
                        <span class="top-button-label">Add Quiz</span>
                        </button>
                        </a>
                     </li>
                     <!-- DELETE -->
                     <li>
                        <button id="deleteItem" class="button--Fry28Tt4id light--3tjxVCiYyF" disabled="">
                        <span aria-label="fas fa-trash-alt" class="fas fa-trash-alt top-bar-icon"></span>
                        <span class="top-button-label">Delete</span>
                        </button>
                     </li>
                     <li>
                        <button id="exportButton" class="button--Fry28Tt4id light--3tjxVCiYyF">
                        <span aria-label="fas fa-download" class="fas fa-download top-bar-icon"></span>
                        <span class="top-button-label">Export</span>
                        </button>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <div class="view-container-3">
         <div class="collection-section--1__DHQagG0">
            <div class="left--3pbjiZ6m4G">
               <ul class="breadcrumb--3AnAv6bJcz">
                  <li><button class="item--3ZMpOg-5QU" disabled="">All quizzes</button> <a href="#fn:allQuizzes" rel="footnote"></a></li>
               </ul>
            </div>
         </div>
         <div class="chapter-list-container">
            <div class="list--24qxBVT_IF">
               <section>
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
                                 <p>Quiz Name</p>
                              </th>
                              <th class="header-cell clickable--lc4pQQLkgC">
                                 <p>Number of Questions</p>
                              </th>
                           </tr>
                        </thead>
                        <tbody id="quizzes-table-body">
                           <tr class="row--16jZlysVSE quiz" id="chapter-template-0" style="display:none;">
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
                                    <span class="switch--52fMu6kGAZ checkbox--2Z3YMYLqUa dark--1gdZ2dJMIJ"><input type="checkbox"/><span></span></span>
                                    </label>
                                 </div>
                              </td>
                              <td class="cell--3QhdjYDo1X">
                                 <div class="cell-content quiz-title"></div>
                              </td>
                              <td class="cell--3QhdjYDo1X">
                                 <div class="cell-content number-of-questions"></div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </section>
            </div>
         </div>
      </div>
   </main>
</div>
<form action="/save-quiz" method="POST" enctype="multipart/form-data" style="display: none" id="postQuizForm">
   {{csrf_field()}}
   <input type="text" name="text" id="xmlFileInput">
   <input type="submit">
</form>
<script>
   function onXMLFileReceived(xmlFile) {
     parseQuizTitles(xmlFile);

     $("#exportButton").click(function(e){
         exportAsXMLFile(xmlFile, "quizzes.xml");
     });

     $('#ok').click(function(e){
       $('#selectAll').prop('checked',false);
         // delete chapters
         $('#quizzes-table-body').find("input[type=checkbox]").each(function(e){
             if($(this).prop('checked')){
               let parentQuiz = $(this).closest(".quiz");
               let id = parentQuiz.attr("id");
               let idNum = id.substring(id.lastIndexOf("-")+1);
               parentQuiz.remove();
               xmlFile = deleteQuiz(idNum, xmlFile);
               numberOfClicked-=1;
             }
         });
         if(numberOfClicked < 1) $("#deleteItem").attr('disabled',true);

         $("#modal").fadeOut("slow").css("display","none");
         $("#xmlFileInput").val(html_beautify(xmlFile));
         $("#postQuizForm").submit();
     });
   }

   $(document).ready(function() {
     requestXMLFile("/xml/quizzes.xml");

     $('#selectAll').change(function() {
     if($(this).prop('checked')) {
         $('.select-quiz').each(function() {
         if(!$(this).prop("checked")) {
             $(this).prop('checked', true);
             numberOfClicked += 1;
         }
         })
         $("#deleteItem").attr('disabled',false);
     }
     else {
         $('.select-quiz').prop('checked', false);
         $("#deleteItem").attr('disabled',true);
         numberOfClicked = 0;
     }
     });

     $("#deleteItem").click(function(e){
         showModal("Delete?","This operation will delete selected quizzes and cannot be undone. Do you wish to proceed?");
     });

     $('#cancel').click(function(e){
       $("#modal").css("display","none");
     });

   });
</script>
@endsection

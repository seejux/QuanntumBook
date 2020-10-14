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
                        <a href="#" style="text-decoration: none" id="new-chapter-button">
                        <button class="button--Fry28Tt4id light--3tjxVCiYyF add-1-Chapter">
                        <span class="fas fa-plus top-bar-icon"></span>
                        <span class="top-button-label">Add one level chapter</span>
                        </button>
                        </a>
                     </li>
                     <!-- TWO LEVEL CHAPTER -->
                     <li>
                        <a href="#" style="text-decoration: none" id="new-two-level-chapter-button">
                        <button class="button--Fry28Tt4id light--3tjxVCiYyF add-2-Chapter">
                        <span class="fas fa-plus top-bar-icon"></span>
                        <span class="top-button-label">Add two level chapter</span>
                        </button>
                        </a>
                     </li>
                     <!-- DELETE -->
                     <li>
                        <button id="deleteItem" class="button--Fry28Tt4id light--3tjxVCiYyF" disabled="">
                        <span class="fas fa-trash-alt top-bar-icon"></span>
                        <span class="top-button-label">Delete</span>
                        </button>
                     </li>
                     <li>
                        <button id="exportButton" class="button--Fry28Tt4id light--3tjxVCiYyF">
                        <span class="fas fa-download top-bar-icon"></span>
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
                  <li><button class="item--3ZMpOg-5QU" disabled="">All chapters </button><a href="#fn:allChapters" rel="footnote"></a></li>
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
                                 <span><span class="fas fa-pen"></span></span>
                              </th>
                              <!-- SELECT ALL -->
                              <th class="header-cell">
                                 <span>
                                 <label class="label--22nuJrNdMC">
                                 <span class="switch--52fMu6kGAZ checkbox--2Z3YMYLqUa light--29kb21gbll"><input id="selectAll" type="checkbox" /><span></span></span>
                                 </label>
                                 </span>
                              </th>
                              <th class="header-cell clickable--lc4pQQLkgC">
                                 <p>Chapter Name</p>
                              </th>
                              <th class="header-cell clickable--lc4pQQLkgC">
                                 <p>Chapter type</p>
                              </th>
                           </tr>
                        </thead>
                        <tbody id="chapters-table-body">
                           <tr class="row--16jZlysVSE chapter" id="chapter-template-0" style="display:none;">
                              <td class="button-cell--15ZsRHax0E cell--3QhdjYDo1X">
                                 <div class="cell-content">
                                    <a href=# class="edit-chapter-link">
                                    <button><span class="fas fa-pen"></span></button>
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
                                 <div class="cell-content chapter-title"></div>
                              </td>
                              <td class="cell--3QhdjYDo1X">
                                 <div class="cell-content chapter-type"></div>
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
<form action="/edit-chapter/1" method="POST" enctype="multipart/form-data" style="display: none" id="postChapterForm">
   {{csrf_field()}}
   <input type="text" name="text" id="xmlFileInput">
   <input type="submit">
</form>
<script>
   function onXMLFileReceived(xmlFile) {
     parseChapterTitles(xmlFile);

     $("#exportButton").click(function(e){
         exportAsXMLFile(xmlFile, "chapters.xml");
     });

     $('#ok').click(function(e){
       $('#selectAll').prop('checked',false);
         // delete chapters
         $('#chapters-table-body').find(".select-chapter").each(function(e){
             if($(this).prop('checked')){
               let parentChapter = $(this).closest(".chapter");
               let id = parentChapter.attr("id");
               let idNum = id.substring(id.lastIndexOf("-")+1);
               parentChapter.remove();
               xmlFile = deleteChapter(idNum, 0, xmlFile);
               numberOfClicked-=1;
             }
         });
         if(numberOfClicked < 1) $("#deleteItem").attr('disabled',true);

         $("#modal").fadeOut("slow").css("display","none");
         $("#xmlFileInput").val(html_beautify(xmlFile));
         $('#xmlFileInput').append('<input type="hidden" name="subChapterNumber" value="0"/>');
         $("#postChapterForm").submit();
     });
   }

   $(document).ready(function() {
     requestXMLFile("/xml/chapters.xml");

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

     $("#deleteItem").click(function(e){
         showModal("Delete?","This operation will delete selected chapters and cannot be undone. Do you wish to proceed?");
     });

     $('#cancel').click(function(e){
       $("#modal").css("display","none");
     });
   });
</script>
@endsection

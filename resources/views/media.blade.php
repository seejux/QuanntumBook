@extends('layouts.app')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="main-content">
   <main class="main">
      <header>
         <nav class="toolbar--2aA3VIsptd light--oIqXlbEbXx">
            <div class="controls--2YAMXys21b grow--2KB1wtNeK3">
               <div class="items-container--3v79arC6i5">
                  <ul class="items--2UaqaDVVnV light--ZAKOwIF2HH">
                     <li>
                        <form action="/media" method="POST" enctype="multipart/form-data" id="postMediaForm">
                           {{csrf_field()}}
                           <input id="media-upload-input" type="file" name="images[]" multiple accept="image/png,image/jpeg,image/gif,image/webp" style="display: none">
                           <button id="media-upload-button" class="button--Fry28Tt4id light--3tjxVCiYyF" type="button"> <span aria-label="fas fa-upload" class="fas fa-upload top-bar-icon"></span><span class="top-button-label">Upload</span></button>
                        </form>
                     </li>
                     <li>
                        <form name="imageName[]" method="POST" enctype="multipart/form-data" id="postMediaFormDelete">
                           {{csrf_field()}}
                           <button id="deleteItem" name="images[]" class="button--Fry28Tt4id light--3tjxVCiYyF" type="button" disabled="true" name="images[]"><span aria-label="fas fa-trash-alt" class="fas fa-trash-alt top-bar-icon"></span><span class="top-button-label">Delete</span></button>
                        </form>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <div class="view-container-3">
         <div>
            <div tabindex="0" class="dropzone--KZJx-aaeEy">
               <div>
                  <div class="collection-section--1__DHQagG0">
                     <div class="left--3pbjiZ6m4G">
                        <ul class="breadcrumb--3AnAv6bJcz">
                           <li><button class="item--3ZMpOg-5QU" disabled="">All media</button><a href="#fn:allMedia" rel="footnote"></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div>
                  <div class="chapter-list-container">
                     <!-- TOOLBAR -->
                     <div class="media-toolbar">
                        <div class="button-group--3ZXJDYPX-3">
                           <button id="image-view-button" class="button--319u6U1AIl icon--2SWnwI7jSC button--30g09RbEvQ" type="button">
                           <span class="text--3HNWf-tIc7"><i class="fas fa-th-large"></i></span></span>
                           </button>
                           <button id="list-view-button" class="button--319u6U1AIl icon--2SWnwI7jSC active--2PPd5kFWvV button--30g09RbEvQ" type="button">
                           <span class="text--3HNWf-tIc7"><i class="fas fa-bars"></i></span>
                           </button>
                        </div>
                     </div>
                     <div id="media-list-view" class="list--24qxBVT_IF">
                        <section>
                           <div class="dark--3w5GzWBb9F">
                              <table class="table--3OVMF8dOBt">
                                 <thead class="header--18fHWvcEtu">
                                    <tr>
                                       <th class="header-cell">
                                          <span>
                                          <label class="label--22nuJrNdMC">
                                          <span class="switch--52fMu6kGAZ checkbox--2Z3YMYLqUa light--29kb21gbll"><input id="selectAll" type="checkbox" /><span></span></span>
                                          </label>
                                          </span>
                                       </th>
                                       <th class="header-cell"><span>Thumbnail</span></th>
                                       <th class="header-cell "><span>Name</span></th>
                                       <th class="header-cell "><span></span></th>
                                       <th class="header-cell "><span>Filesize</span></th>
                                       <th class="header-cell "><span></span></th>
                                       <th class="header-cell "><span></span></th>
                                    </tr>
                                 </thead>
                                 <tbody id="media-table-body">
                                    <!-- LOOP IMAGES IN LIST VIEW -->
                                    @unless (empty($thumbnails))
                                    @foreach ($thumbnails as  $image)
                                    <tr class="row--16jZlysVSE media-listView">
                                       <td class="cell--3QhdjYDo1X small--1KOK57-GZT">
                                          <div class="cell-content">
                                             <label class="label--22nuJrNdMC">
                                             <span class="switch--52fMu6kGAZ checkbox--2Z3YMYLqUa dark--1gdZ2dJMIJ"><input class="select-media" type="checkbox" /><span></span></span>
                                             </label>
                                          </div>
                                       </td>
                                       <td class="cell--3QhdjYDo1X">
                                          <div class="cell-content"><img class="media-thumbnail" src="{{ url('/thumbnail-uploader/'.$image[0].'') }}" /></div>
                                       </td>
                                       <td class="cell--3QhdjYDo1X">
                                          <div class="cell-content image-name" >{{ $image[0] }}</div>
                                       </td>
                                       <td class="cell--3QhdjYDo1X">
                                          <div class="cell-content"></div>
                                       </td>
                                       <td class="cell--3QhdjYDo1X">
                                          <div class="cell-content">{{ $image[1] }}</div>
                                       </td>
                                       <td class="cell--3QhdjYDo1X">
                                          <div class="cell-content"></div>
                                       </td>
                                       <td class="cell--3QhdjYDo1X">
                                          <div class="cell-content"></div>
                                       </td>
                                    </tr>
                                    @endforeach
                                    @endunless
                                 </tbody>
                              </table>
                           </div>
                           <nav class="pagination--1eeM3Kvldi">
                              <span class="display--2vbfghRVvn">Items per page:</span>
                              <span>
                                 <select class="itemsPerPage-select">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                 </select>
                              </span>
                              <div class="loader--d5Z5tZSNVf"></div>
                              <div class="button-group--3ZXJDYPX-3">
                                 <button id="backward-button" class="button--319u6U1AIl icon--2SWnwI7jSC button--30g09RbEvQ" disabled="" type="button"><i class="fas fa-angle-left button-icon--2zwDFL5-yo"></i></button>
                                 <button id="forward-button" class="button--319u6U1AIl icon--2SWnwI7jSC button--30g09RbEvQ" type="button"><i class="fas fa-angle-right button-icon--2zwDFL5-yo"></i></button>
                              </div>
                           </nav>
                        </section>
                     </div>
                     <!-- LOOP IMAGE IN IMAGE VIEW -->
                     <div id="media-image-view" class="list--24qxBVT_IF">
                        <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL image-input-container">
                           @unless (empty($thumbnails))
                           @foreach ($thumbnails as  $image)
                           <div class="media-imageView" style="display: inline-block">
                              <div class="media-card--3zwVt4x9IY">
                                 <div class="media-image-view-header">
                                    <div class="description--KIscyejKfD" role="button">
                                       <div class="title--2BoVb9Cwl9">
                                          <label class="label--22nuJrNdMC" style="align-items: unset">
                                             <span class="switch--52fMu6kGAZ checkbox--2Z3YMYLqUa dark--1gdZ2dJMIJ "><input class="select-media" type="checkbox" /><span></span></span>
                                             <div>
                                                <div class="title-text--1DQCap-AbL">
                                                   <div  class="cropped-text--kjpmxHAsTL" >
                                                      <div aria-hidden="true" class="front--3wwBW91aMg image-name" >{{ $image[0] }}</div>
                                                </div>
                                             </div>
                                       </div>
                                       </label>
                                    </div>
                                    <div class="meta--Lq76ippoF_">
                                       <div aria-label="image/jpeg 76.09 KB" class="cropped-text--kjpmxHAsTL" title="image/jpeg 76.09 KB">
                                          <div aria-hidden="true" class="back--2lOqwyu_8t"><span>{{ $image[1] }}</span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="media--1-OiFQVLjc" role="button">
                                 <img src="{{url('/thumbnail-uploader/'.$image[0].'')}}" />
                              </div>
                           </div>
                        </div>
                        @endforeach
                        @endunless
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</div>
</main>
</div>
<script>
   let numberOfImages;
   let imageNames = [];
   let allowUpload = 0;
   let validExtensions = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];


   $(document).ready(function(){
     numberOfImages = $(".media-listView").length;
     setNumberOfPages(numberOfImages);

     // View the page with LIST VIEW active
     $('#media-image-view').css('display','none');

     // Checkbox triggerer when the image inside Image Viewer has been clicked
     $('.media--1-OiFQVLjc').click(function(e){
         let checkbox = $(this).closest('.media-card--3zwVt4x9IY').find("input[type=checkbox]");
         checkbox.prop("checked", !checkbox.prop("checked"));
         e.preventDefault();
         checkbox.trigger("change");
      });

     // Check if any checbox has been triggered -> activate Delete Button
     $('.media-listView').find(".select-media").each(function(){
         $(this).change(function(){
             checkboxClicked($(this));
         });
     });
     
     $('.media-imageView').find(".select-media").each(function(){
         $(this).change(function(){
             checkboxClicked($(this));
         });
     });

     $("#media-upload-button").on("click", function() {
         $("input[type=file]").trigger("click");
      });

     $('#media-upload-input').change(function() {
       if (this !== undefined) {
         for (let i = 0; i < this.files.length; ++i) {
           let fileType = this.files[i]["type"];
           if ($.inArray(fileType, validExtensions) < 0) {allowUpload = 1;}
         };

         if (allowUpload <= 0) {
           $('#postMediaForm').submit();
         }
         else {
           alert("Image type not allowed. Accepted image types: JPG, PNG, GIF & WEBP");
         }
         // this.files[0] = allowUpload;
         // $('#postMediaForm').submit();
         // console.log(this.files);
         // if ($.inArray(fileType, validExtensions) >= 0) {
         //   $('#postMediaForm').submit();
         // } else {
         //   alert("Image type not allowed. Accepted image types: JPG, PNG, GIF & WEBP");
         // }
       }

     });

     // Check all checkboxes
     $('#selectAll').change(function() {
     if($(this).prop('checked')) {
         $('.select-media').each(function(n) {
         if (n >= pageSize * (pageCounter - 1) && n < pageSize * pageCounter) {
           if(!$(this).prop("checked")) {
               $(this).prop('checked', true);
               numberOfClicked += 1;
           }
         }
         })
         $("#deleteItem").attr('disabled',false);
     }
     else {
         $('.select-media').prop('checked', false);
         $("#deleteItem").attr('disabled',true);
         numberOfClicked = 0;
     }
     });

     // Delete Images
     $("#deleteItem").click(function(e){
         showModal("Delete?","This operation will delete selected images and cannot be undone. Do you wish to proceed?");
     });

     $('#cancel').click(function(e){
     $("#modal").css("display","none");
     });

     $('#ok').click(function(e){
       $('#selectAll').prop('checked',false);
         // delete images
         $('#media-table-body').find("input[type=checkbox]").each(function(e){
             if($(this).prop('checked')){
               let parentImage = $(this).closest(".media-listView");
               let imageName = parentImage.find('.image-name').text();
               imageNames.push(imageName);
               numberOfClicked-=1;
             }
         });

         // delete in image view
         $('#media-image-view').find("input[type=checkbox]").each(function(e){
             if($(this).prop('checked')){
               let parentImage = $(this).closest(".media-imageView");
               let imageName = parentImage.find('.image-name').text();
               imageNames.push(imageName);
               numberOfClicked-=1;
             }
         });

         if(imageNames.length !== 0) {
            $('#postMediaFormDelete').attr("action", "/media/delete/"+imageNames+"");
            $('#postMediaFormDelete').submit();
         }         

         if(numberOfClicked < 1) $("#chapters-delete-button").attr('disabled',true);

         $("#modal").fadeOut("slow").css("display","none");
     });

     // Forward
     $('#forward-button').click(function() {
       goForward('#forward-button','#backward-button');
     });

     // Backward
     $('#backward-button').click(function() {
       goBackward('#forward-button','#backward-button');
     });

     scrollOnOpenSelect('.itemsPerPage-select', ".view-container-3", ".view-container-3", 0);

   });

</script>
@endsection

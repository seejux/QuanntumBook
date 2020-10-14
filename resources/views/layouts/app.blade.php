@extends('layouts.base')
@section('body')
<div id="application">
   <div class="root visible--2-6zspTYQo navigation-visible">
      <nav class="navigation">
         <div class="navigation--1TPKGVcdtJ">
            <div class="header--1yYASq55gP">
               <div style="padding: 15px 40px; display: flex"><img src="/img/profile.png" height="30"><span class="panel-header">Quantum Admin</span></div>
            </div>
            <div class="user--1yh8_EoOW4">
               <div class="user-content--1HWDvaZ5qI">
                  <button class="no-user-image--2r0uxVSaEY"><span aria-label="fa-user" class="fa fa-user"></span></button>
                  <div class="user-profile--3h8wK9aFMr">
                     <button class="username--1iD-BWgeXO">{{ Auth::user()->name ?? "" }}</button><br>
                     <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     <button class="logout-button"><i class="fa fa-sign-out-alt" style="margin-right: 8px"></i>Log out</button>
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                     </form>
                  </div>
               </div>
            </div>
            <div class="items--23JrT1L7Qn">
               <div class="item--2MP4_Vp3Oe @if(Route::current()->getName() == 'home') active--2cQkrWKevT @endif">
                  <a href="/home" style="text-decoration: none">
                     <div class="sidebar-title" role="button" style="color: white"><i class="fas fa-home dashboard-icons"></i>Home</div>
                  </a>
               </div>
               <div class="item--2MP4_Vp3Oe @if(Route::current()->getName() == 'chapters') active--2cQkrWKevT @endif">
                  <a href="/chapters" style="text-decoration: none">
                     <div class="sidebar-title" role="button" style="color: white"><i class="fas fa-file-alt dashboard-icons"></i> Chapters</div>
                  </a>
               </div>
               <div class="item--2MP4_Vp3Oe @if(Route::current()->getName() == 'quizzes') active--2cQkrWKevT @endif">
                  <a href="/quizzes" style="text-decoration: none">
                     <div class="sidebar-title" role="button" style="color: white"><i class="fas fa-question dashboard-icons"></i>Quizzes</div>
                  </a>
               </div>
               <div class="item--2MP4_Vp3Oe @isset($chapterNumber) @if(Route::current()->getName() == 'edit-chapter.show' and $chapterNumber == 0) active--2cQkrWKevT @endif @endisset">
                  <a href="/edit-chapter/0" style="text-decoration: none">
                     <div class="sidebar-title" role="button" style="color: white"><i class="fas fa-info dashboard-icons"></i>About Section</div>
                  </a>
               </div>
               <div class="item--2MP4_Vp3Oe @if(Route::current()->getName() == 'media.show') active--2cQkrWKevT @endif">
                  <a href="/media" style="text-decoration: none">
                     <div class="sidebar-title" role="button" style="color: white"><i class="fas fa-file-image dashboard-icons"></i>Media</div>
                  </a>
               </div>
               <div class="item--2MP4_Vp3Oe @if(Route::current()->getName() == 'options') active--2cQkrWKevT @endif">
                  <a href="/options" style="text-decoration: none">
                     <div class="sidebar-title" role="button" style="color: white"><i class="fas fa-cog dashboard-icons"></i>Options</div>
                  </a>
               </div>
            </div>
         </div>
      </nav>
      @yield('content')

   </div>
</div>
<!-- MODAL -->
<div id="modal" style="display:none;">
   <div class="backdrop--1NPZgaTLwy visible--2Ns3EfQy8A fixed--2GqQpeyTUu" role="button"></div>
   <div class="dialog-container open--1ztEKgXgPI">
      <div class="dialog--RUeFRUqJ7i">
         <section class="content--1lT7Ozsit1">
            <header></header>
            <article></article>
            <footer>
               <button id="ok" class="button--319u6U1AIl primary--1wekDI7P-q" type="button"><span class="text--3HNWf-tIc7">Ok</span></button>
               <button id="cancel" class="button--319u6U1AIl add-button" type="button"><span class="text--3HNWf-tIc7">Cancel</span></button>
            </footer>
         </section>
      </div>
   </div>
</div>

@if(Route::current()->getName() == 'edit-chapter.show' or Route::current()->getName() == 'edit-two-level-chapter.show' or Route::current()->getName() == 'edit-quiz.show')

<!-- ICON MODAL -->
<div id="icon-modal" style="display:none;">
   <div class="backdrop--1NPZgaTLwy visible--2Ns3EfQy8A fixed--2GqQpeyTUu" role="button"></div>
   <div class="dialog-container open--1ztEKgXgPI" >
      <div class="dialog--RUeFRUqJ7i"
         style="width:70vw;
         min-width: 600px;
         height: 90vh;
         overflow: auto;
         white-space: nowrap;">
         <section class="content--1lT7Ozsit1" style="padding: 20px 30px;">
            <div style="display: flex;
               flex-direction: column;
               flex-grow: 1;">
               <div tabindex="0" class="dropzone--KZJx-aaeEy">
                  <div>
                     <div class="collection-section--1__DHQagG0" style="border-bottom: 1px solid #ccc; margin-bottom: 15px">
                        <div class="left--3pbjiZ6m4G">
                           <ul class="breadcrumb--3AnAv6bJcz">
                              <li><button class="item--3ZMpOg-5QU" disabled="">All media</button></li>
                           </ul>
                        </div>
                        <div class="right--2KDxSCdQMZ">
                           <span aria-label="fas fa-times" class="fas fa-times clickable--2-TzL1jn1k icon--3x5ECMVMng" role="button" tabindex="0"></span>
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
                                       <tr class="row--16jZlysVSE media-listView iconModal-listView" style="cursor:pointer">
                                          <td class="cell--3QhdjYDo1X">
                                             <div class="cell-content"><img class="media-thumbnail" src="{{url('/thumbnail-uploader/'.$image[0].'')}}" /></div>
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
                           <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL" style="display: flex; flex-wrap: wrap;">
                              <table class="table--3OVMF8dOBt">
                              <tbody>
                                 @unless (empty($thumbnails))
                                 @foreach ($thumbnails as  $image)
                                 <div class="iconModal-imageView">
                                    <div class="media-card--3zwVt4x9IY">
                                       <div class="media-image-view-header">
                                          <div class="description--KIscyejKfD" role="button">
                                             <div class="title--2BoVb9Cwl9">
                                                <div>
                                                   <div class="title-text--1DQCap-AbL">
                                                      <div aria-label="roadtrip.jpg" class="cropped-text--kjpmxHAsTL" title="roadtrip.jpg">
                                                         <div aria-hidden="true" class="front--3wwBW91aMg image-name" >{{$image[0]}}</div>
                                                      </div>
                                                   </div>
                                                </div>
                                                </label>
                                             </div>
                                             <div class="meta--Lq76ippoF_">
                                                <div aria-label="image/jpeg 76.09 KB" class="cropped-text--kjpmxHAsTL" title="image/jpeg 76.09 KB">
                                                   <div aria-hidden="true" class="back--2lOqwyu_8t"><span>{{$image[1]}}</span></div>
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
         </section>
         </div>
         </div>
      </div>
   </div>
</div>

@endif

<!-- FOOTNOTES -->
<!-- <a href="#fn:1" rel="footnote"></a> -->
<div class="footnotes">
    <ol>
    <li class="footnote" id="fn:invertImage"><p class="footnote-text">Ticking this checkbox will cause this button to use a light background instead of inheriting the chapter's theme colour.</p></li>
    <li class="footnote" id="fn:allMedia"><p class="footnote-text">Here, you can view, upload and delete your own images and icons that you wish to use in the app. Click the upload button at the top to upload new images.</p></li>
    <li class="footnote" id="fn:allChapters"><p class="footnote-text">All chapters are displayed below. Use the buttons at the top to add either a one-level chapter or a two-level chapter (with subchapters). To edit a chapter, click the pen icon on the left of the chapter entry. To delele a chapter, check the corresponding checkbox and click the delete button at the top.</p></li>
    <li class="footnote" id="fn:allQuizzes"><p class="footnote-text">All quizzes are displayed below. To edit a quiz, click the pen icon on the left of the quiz entry. To delele a quiz, check the corresponding checkbox and click the delete button at the top.</p></li>
    <li class="footnote" id="fn:tabOptions"><p class="footnote-text">Choose which tabs you wish to display in the app bar</p></li>
    <li class="footnote" id="fn:chapterIconLink"><p class="footnote-text">Click the image icon on the left to select an image from the Media tab. Alternatively, copy an image URL into the input field.</p></li>
    <li class="footnote" id="fn:Content"><p class="footnote-text">Use the Add Element button to add a new element block. Use the drop-down selector within the block in order to choose an element / the content’s type / the type of the content. The order of the Element blocks can be changed by dragging the blocks up and down. Element blocks can be deleted using the bin icon. Note: Inline paragraphs do not need separate Element blocks</p></li>
    <li class="footnote" id="fn:shuffleQuestions"><p class="footnote-text">Ticking this checkbox will shuffle the questions every time the user launches the quiz</p></li>
    <li class="footnote" id="fn:correctAnswerExplanation"><p class="footnote-text">Correct Answer Explanation</p></li>
    <li class="footnote" id="fn:aboutSectionIconLink"><p class="footnote-text">About Section Icon Link</p></li>
    <li class="footnote" id="fn:premiumChapter"><p class="footnote-text">Ticking this checkbox will make the chapter visible only for users who made a purchase.</p></li>
    <li class="footnote" id="fn:premiumQuiz"><p class="footnote-text">Ticking this checkbox will make the quiz visible only for users who made a purchase.</p></li>
    <li class="footnote" id="fn:lightTheme"><p class="footnote-text">Ticking this checkbox will cause this button to use a light background instead of inheriting the chapter's theme colour.</p></li>
    </ol>
</div>

@endsection

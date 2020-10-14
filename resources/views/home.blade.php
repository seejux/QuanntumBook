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
               </ul>
            </div>
         </div>
      </nav>
   </header>
   <div class="view-container-3">
      <div class="new-chapter-form">
         <div class="grid--370cPalb_8 grid--3IQZeqSYws">
            <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
               <label class="section-label" for="themes">Main Theme *</label>
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
                  <label class="section-label" for="app-name-input">App Name *</label>
                  <div class="field">
                     <label class="input left--3McDXiCrys headline"><input id="app-name-input" type="text" value="" /></label>
                  </div>
                  <label class="error-label" id="title-error-label"></label>
               </div>
            </div>
            <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
               <div class="field">
                  <div style="display: flex; width: 100%">
                     <label class="section-label">Tab Options </label>
                     <a href="#fn:tabOptions" rel="footnote"></a>
                  </div>
                  <div class="field-container">
                     <div class="field" style="display: flex">
                        <input type="checkbox" id="enable-theory-checkbox" checked>
                        <label class="section-label checkbox-label" for="enable-theory-checkbox">Enable Theory Tab</label>
                     </div>
                     <div class="field" style="display: flex">
                        <input type="checkbox" id="enable-tests-checkbox" checked>
                        <label class="section-label checkbox-label" for="enable-tests-checkbox">Enable Tests Tab</label>
                     </div>
                     <div class="field" style="display: flex">
                        <input type="checkbox" id="enable-support-checkbox" checked>
                        <label class="section-label checkbox-label" for="enable-support-checkbox">Enable Support Tab</label>
                     </div>
                  </div>
                  <label class="error-label"></label>
               </div>
            </div>
            <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
               <div class="field">
                  <div style="display: flex; width: 100%">
                     <label class="section-label">Toolbar Options </label>
                  </div>
                  <div class="field-container">
                     <div class="field" style="display: flex">
                        <input type="checkbox" id="enable-appname-checkbox" checked>
                        <label class="section-label checkbox-label" for="enable-appname-checkbox">Show App Name in Toolbar</label>
                     </div>
                     <div class="field" style="display: flex">
                        <input type="checkbox" id="enable-tabs-checkbox" checked>
                        <label class="section-label checkbox-label" for="enable-tabs-checkbox">Show Tab Names in Toolbar</label>
                     </div>
                  </div>
                  <label class="error-label"></label>
               </div>
            </div>
            <div class="item--3RIViIi05o grid-item colSpan--1-dAvrr6Hs colSpan-12--auvwGOVazL">
               <div class="field">
                  <label class="section-label">Ad Options</label>
                  <div class="field-container">
                     <div class="field" style="display: flex">
                        <input type="checkbox" id="enable-ads-checkbox">
                        <label class="section-label checkbox-label" for="enable-ads-checkbox">Enable Ads</label>
                     </div>
                  </div>
                  <label for="time-between-ads" class="section-label" style="display: inline; margin-right: 10px">Ad Frequency:</label>
                  <div class="input left--3McDXiCrys" style="margin-bottom: 15px;align-items: center;width: 50px;height: 40px;">
                     <input id="time-between-ads" class="image-width-input" type="number" value="5" min="1" style="text-align: center">
                  </div>
                  <label for="time-between-ads" class="section-label" style="margin-left: 10px; display: inline;">minutes</label>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<form action="/save-options" method="POST" enctype="multipart/form-data" style="display: none" id="postAppOptionsForm">
   {{csrf_field()}}
   <input type="text" name="text" id="xmlFileInput">
   <input type="submit">
</form>
<script>
   $(document).ready(function() {
     requestXMLFile("/xml/options.xml");

     $('#postChapterForm').submit(function () {
         window.onbeforeunload = null;
     });

     $("#title-input").change(function() {
       $("#title-error-label").text("");
     });
   });


   function onXMLFileReceived(xmlFile) {
   loadOptionsFromXML(xmlFile);

   $("#save-button").click(function() {
     saveOptionsToXML(xmlFile);
   });
   }

</script>
@endsection

let modalTrigerrer;
let pageSize = 10; // Default value
let pageCounter = 1;
let numberOfPages;
let forwardButton;
let backwardButton;

function setNumberOfPages(numberOfImages){
  numberOfPages = Math.ceil(numberOfImages/pageSize);
}

function showImagePicker(triggeringElement) {
  modalTrigerrer = triggeringElement;
  numberOfImages = $(".media-listView").length;
  setNumberOfPages(numberOfImages);
  $("#icon-modal").fadeIn().css("display","block");
}

// animation on Select
function checkSelect(select, divToExpand){
  if ($(select).hasClass('open')){
    $(divToExpand).css("padding-bottom",30);
  }
}

// animation on opening Select
function scrollOnOpenSelect(select, divToExpand, divToScroll, n) {
  $(select).click(function(){
    if (n !== 0) {
      $(divToExpand).css("padding-bottom",150);
    }
    $(divToScroll).animate({ scrollTop: $(divToScroll)[n].scrollHeight}, 500);
    checkSelect(select, divToExpand);
  });
}

function goForward(fb, bb) {
  forwardButton = fb;
  backwardButton = bb;

  pageCounter +=1;

  showPage(pageCounter);
  resetButtonFunctions();
  if(pageCounter >= numberOfPages) $(fb).attr("disabled", true);
  $(bb).attr("disabled", false);
}

function goBackward(fb, bb) {
  pageCounter -= 1;

  showPage(pageCounter);
  resetButtonFunctions();
  if(pageCounter <= 1) $(bb).attr("disabled", true);
  $(fb).attr("disabled", false);
}

function showPage(page) {
  $(".media-listView").hide();
  $(".media-listView").each(function(n) {
    if(n >= pageSize * (page - 1) && n < pageSize * page) {
      $(this).show();
    }
  });

  resetButtonFunctions();
}

function resetButtonFunctions() {
  numberOfImages = $(".media-listView").length;
  if(numberOfImages <= pageSize)  {
    $('#forward-button').attr("disabled", true);
    $('#backward-button').attr("disabled", true);
  }
  else if (pageCounter==1){
    $('#forward-button').attr("disabled", false);
    $('#backward-button').attr("disabled", true);
  }
  else {
    $('#forward-button').attr("disabled", false);
    $('#backward-button').attr("disabled", false);
  }
}

// Reset the checkboxes on change of view
function resetCheckboxes(div){
  $(div).find(".select-media").each(function(){
    numberOfClicked = 0;
    $('#selectAll').prop("checked", false);
    $("#deleteItem").attr('disabled',true);
    $(this).prop('checked', false);
  });
}

// Change image thumbnail and image title
function changeIconImageTitle(thumbnailContainer) {
  let imageName = $(thumbnailContainer).find('.image-name').text();
  let url = window.location.origin + "/media-uploader/" + imageName;

  let imageInput = modalTrigerrer.closest(".image-input-container").find(".image-link-input");
  imageInput.val(url);
  if(imageInput.attr("id") === "icon-input") loadIconThumbnail(imageInput);
  else loadImageThumbnail(imageInput);
}

$(document).ready(function() {
  $(".add-icon-image").click(function() {
    showImagePicker($(this));
  });

  $(".iconModal-listView, .iconModal-imageView").click(function() {
    $("#icon-modal").css("display","none");
    changeIconImageTitle($(this));
  });

  $('.dialog--RUeFRUqJ7i').click(function(){
    checkSelect();
  });

  // View the page with LIST VIEW active
  $('#media-image-view').css('display','none');

  $('.itemsPerPage-select').change(function(){
    pageSize = $(this).children("option:selected").val();
    numberOfPages = Math.ceil(numberOfImages/pageSize);
    pageCounter = 1; // reset counter
    showPage(1);
  })

  // Checkbox triggerer when the image inside Image Viewer has been clicked
  // $('.media--1-OiFQVLjc').click(function(){
  //   let checkbox = $(this).closest('.media-card--3zwVt4x9IY').find("input[type=checkbox]");
  //   checkbox.prop("checked", !checkbox.prop("checked"));
  // });


  // Close Modal on outside click
  $(".dialog-container, .fa-times").click(function(e) {
    if (e.target !== this) return;
    $("#icon-modal").css("display","none");
    $(".content--1lT7Ozsit1").css("padding-bottom",30);
  });

  showPage(1);

  // enable image view
  $('#image-view-button').click(function(){
    $(this).addClass('active--2PPd5kFWvV');
    $('#list-view-button').removeClass('active--2PPd5kFWvV');
    $('#media-image-view').css('display','block');
    $('#media-list-view').css('display','none');

    resetAllCheckboxes();
  });

  // enable list view
  $('#list-view-button').click(function(){
    $(this).addClass('active--2PPd5kFWvV');
    $('#image-view-button').removeClass('active--2PPd5kFWvV');
    $('#media-list-view').css('display','block');
    $('#media-image-view').css('display','none');

    resetAllCheckboxes();
  });

  // Reset the checkboxes on change of view
  function resetAllCheckboxes() {
    resetCheckboxes('.iconModal-imageView');
    resetCheckboxes('.media-listView');
    resetCheckboxes('.media-imageView');
  }

  $('select').niceSelect();
});

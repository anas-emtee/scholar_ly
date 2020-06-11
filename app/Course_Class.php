<?php
function uploadIcon($lt){
  $icon = "";
  switch ($lt) {
      case "video":
          $icon = "<i class='fa fa-play' style='padding-right:10px;'></i>";
          break;
      case "text":
          $icon = "<i class='fa fa-file'></i>";
          break;
      case "downloadable":
          $icon = "<i class='fa fa-download'></i>";
          break;
      case "quiz":
          $icon = "<i class='fa fa-question-circle'></i>";
          break;
      case "exercise":
          $icon = "<i class='fa fa-hourglass'></i>";
          break;
      case "activity":
          $icon = "<i class='fa fa-edit'></i>";
          break;
      default:
          break;
  }
  return $icon;
}

 ?>

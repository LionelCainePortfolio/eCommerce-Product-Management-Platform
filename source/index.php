<?php
require_once "config.php";
ini_set('display_errors', 'Off');

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit();
}
?>
<html>
<head>
  <link rel="stylesheet" charset="UTF-8" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css">
  <link rel="stylesheet" href="https://unpkg.com/react-select@1.2.1/dist/react-select.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700;900&amp;display=swap" rel="stylesheet">
  <link href="main.css" rel="stylesheet">
  <script src="https://unpkg.com/react-select@1.2.1/dist/react-select.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://js.chargebee.com/v2/animation.css" type="text/css">
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.0/js/foundation.min.js"></script>
  <script src="alertify.js"></script>

<style data-styled="active" data-styled-version="5.3.5"></style>
<style>
  .ekGoRi{
    border:  1px solid rgb(38 121 203) !important;
    background-color: rgb(38 121 203) !important;
  }
.adding_by_id_avatar{
      width: 30px;
    margin-top: 5px;
    height: 30px;
    border-radius: 50%;
}
  #add_product_button{
    display: none;
  }
.alertify,
.alertify-show,
.alertify-log {
  -webkit-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
  -moz-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
  -ms-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
  -o-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
  transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
  /* easeOutBack */
}

.alertify-hide {
  -webkit-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  -moz-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  -ms-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  -o-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  /* easeInBack */
}

.alertify-log-hide {
  -webkit-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  -moz-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  -ms-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  -o-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045) !important;
  /* easeInBack */
}

.alertify-cover {
  position: fixed !important;
  z-index: 99999 !important;
  top: 0 !important;
  right: 0 !important;
  bottom: 0 !important;
  left: 0 !important;
  background-color: white !important;
  filter: alpha(opacity=0) !important;
  opacity: 0 !important;
}

.alertify-cover-hidden {
  display: none !important;
}

.alertify {
  position: fixed !important;
  z-index: 99999 !important;
  top: 50px !important;
  left: 50% !important;
  width: 550px !important;
  margin-left: -275px !important;
  opacity: 1 !important;
}

.alertify-hidden {
  -webkit-transform: translate(0, -150px) !important;
  -moz-transform: translate(0, -150px) !important;
  -ms-transform: translate(0, -150px) !important;
  -o-transform: translate(0, -150px) !important;
  transform: translate(0, -150px) !important;
  opacity: 0 !important;
  display: none !important;
}

/* overwrite display: none; for everything except IE6-8 */
:root * > .alertify-hidden {
  display: block !important;
  visibility: hidden !important;
}

.alertify-logs {
  position: fixed !important;
  z-index: 5000 !important;
  bottom: 10px !important;
  right: 10px !important;
  width: 300px !important;
}

.alertify-logs-hidden {
  display: none !important;
}

.alertify-log {
  display: block !important;
  margin-top: 10px !important;
  position: relative !important;
  right: -300px !important;
  opacity: 0 !important;
}

.alertify-log-show {
  right: 0 !important;
  opacity: 1 !important;
}

.alertify-log-hide {
  -webkit-transform: translate(300px, 0) !important;
  -moz-transform: translate(300px, 0) !important;
  -ms-transform: translate(300px, 0) !important;
  -o-transform: translate(300px, 0) !important;
  transform: translate(300px, 0) !important;
  opacity: 0 !important;
}

.alertify-dialog {
  padding: 25px !important;
}

.alertify-resetFocus {
  border: 0 !important;
  clip: rect(0 0 0 0) !important;
  height: 1px !important;
  margin: -1px !important;
  overflow: hidden !important;
  padding: 0 !important;
  position: absolute !important;
  width: 1px !important;
}

.alertify-inner {
  text-align: center !important;
}

.alertify-text {
  margin-bottom: 15px !important;
  width: 100% !important;
  -webkit-box-sizing: border-box !important;
  -moz-box-sizing: border-box !important;
  box-sizing: border-box !important;
  font-size: 100% !important;
}

.alertify-button,
.alertify-button:hover,
.alertify-button:active,
.alertify-button:visited {
  background: none !important;
  text-decoration: none !important;
  border: none !important;
  /* line-height and font-size for input button */
  line-height: 1.5 !important;
  font-size: 100% !important;
  display: inline-block !important;
  cursor: pointer !important;
  margin-left: 5px !important;
}

@media only screen and (max-width: 680px) {
  .alertify,
  .alertify-logs {
    width: 90% !important;
    -webkit-box-sizing: border-box !important;
    -moz-box-sizing: border-box !important;
    box-sizing: border-box !important;
  }

  .alertify {
    left: 5% !important;
    margin: 0 !important;
  }
}
/**
 * Default Look and Feel
 */
.alertify,
.alertify-log {
  font-family: sans-serif;
}

.alertify {
  background: #FFF !important;
  border: 10px solid #333 !important;
  /* browsers that don't support rgba */
  border: 10px solid rgba(0, 0, 0, 0.7) !important;
  border-radius: 8px !important;
  box-shadow: 0 3px 3px rgba(0, 0, 0, 0.3) !important;
  -webkit-background-clip: padding !important;
  /* Safari 4? Chrome 6? */
  -moz-background-clip: padding !important;
  /* Firefox 3.6 */
  background-clip: padding-box !important;
  /* Firefox 4, Safari 5, Opera 10, IE 9 */
}

.alertify-text {
  border: 1px solid #CCC !important;
  padding: 10px !important;
  border-radius: 4px !important;
}

.alertify-button {
  border-radius: 4px !important;
  color: #FFF !important;
  font-weight: bold !important;
  padding: 6px 15px !important;
  text-decoration: none !important;
  text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.5) !important;
  box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.5) !important;
  background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0)) !important;
  background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0)) !important;
  background-image: -ms-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0)) !important;
  background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0)) !important;
  background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0)) !important;
}

.alertify-button:hover,
.alertify-button:focus {
  outline: none;
  background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent) !important;
  background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent) !important;
  background-image: -ms-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent) !important;
  background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent) !important;
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0)) !important;
}

.alertify-button:focus {
  box-shadow: 0 0 15px #2B72D5 !important;
}

.alertify-button:active {
  position: relative !important;
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05) !important;
}

.alertify-button-cancel,
.alertify-button-cancel:hover,
.alertify-button-cancel:focus {
  background-color: #FE1A00 !important;
  border: 1px solid #D83526 !important;
}

.alertify-button-ok,
.alertify-button-ok:hover,
.alertify-button-ok:focus {
  background-color: #5CB811 !important;
  border: 1px solid #3B7808 !important;
}

.alertify-log {
  background: #1F1F1F !important;
  background: rgba(0, 0, 0, 0.9) !important;
  padding: 15px !important;
  border-radius: 4px !important;
  color: #FFF !important;
  text-shadow: -1px -1px 0 rgba(0, 0, 0, 0.5) !important;
}

.alertify-log-error {
  background: #FE1A00 !important;
  background: rgba(254, 26, 0, 0.9) !important;
}

.alertify-log-success {
  background: #5CB811 !important;
  background: rgba(92, 184, 17, 0.9) !important;
}



  .radio_clicked{
background-color: orange !important;
  }
  .kMJAoa .Header__HeaderContent{
    max-width: 1450px !important;
  }
  .intercom__categories-section{
    display: none;
  }
  .sc-fJoEar{
    display: none;
  }
  .hdxmeq_active{
    padding: 5px;
    border: 1px solid orange;
    background: orange;
    border-radius: 10px;
  }
  .hTOJBx{
    margin-right: 10px;
        padding: 5px;

  }
.hdxmeq:hover{
    border: 1px solid orange;
    border-radius: 10px;
    padding: 5px;

}
.ikJpAo{
  display: none;
}
.variable_div{
  margin:  15px;
}
.variable_div_small{
  margin-right:  25px;
  margin-bottom: 15px;
}

.variablesModal div:last-child{
  margin-bottom: 15px !important;
}
.variables{
  text-align: center;
}
.variables div:last-child{
  margin-bottom: 15px !important;
}
.varFilter{
  filter:  none !important;
  border: 1.5px solid orange;
}

.variables img {
  filter: grayscale();
width: 100%;
height: 100%;
box-shadow: 1px 1px 10px 2px rgba(0, 0, 0, 0.3);
transition: filter 0.4s ease-in-out;
position: relative;
}
.variables:hover img {
  cursor: pointer;
}
.variablesModal img {
  filter: grayscale();
width: 100%;
height: 100%;
box-shadow: 0.5px 0.5px 0.5px 1px rgba(0, 0, 0, 0.15);
transition: filter 0.4s ease-in-out;
position: relative;
}
.variablesModal:hover img {
  cursor: pointer;
}
.variablesModal .title {
  font-family: "Dancing Script", cursive;
  font-size: 3rem;
  color: whitesmoke;
  position: relative;
}

.variablesModal .title::after {
  position: absolute;
  content: "";
  width: 0%;
  height: 4px;
  background-color: whitesmoke;
  left: 50%;
  bottom: -10px;
  transition: all 0.4s ease-in-out;
}

.variablesModal:hover .title::after {
  width: 100%;
  left: 0;
}
.range-value{
    position: absolute;
    border-radius: 3px;
    top: -55px;
    padding: 3px 3px;
    padding-top: 26px;
    padding-bottom: 25px;
    width: 56px;
    height: 51px;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 12px;
    font-weight: bold;
    color: white;
    margin-left: 0.5%;
    text-align: center;
    line-height: 22px;
    white-space: nowrap;
    transition: left 0.045s linear;
    background-color: #ffa500;
    border-radius: 50% 50% 50% 0%;
}
.range-value span{
    width: 40px;
    height: 24px;
    line-height: 5px;
    text-align: center;
    color: #fff;
    font-size: 12px;
    display: block;
    position: absolute;
    left: 50%;
    transform: translate(-50%, 0);
    border-radius: 6px;
}
.range-value span:before{
  content: "";
  position: absolute;
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  margin-top: -1px;
}
.range-value-info{
    position: absolute;
    border-radius: 3px;
    top: -55px;
    padding: 3px 3px;
    padding-top: 26px;
    padding-bottom: 25px;
    width: 56px;
    font-family: Helvetica, Arial, sans-serif;
    font-size: 17px;
    font-weight: bold;
    color: white;
    margin-left: 0.5%;
    text-align: center;
    line-height: 22px;
    white-space: nowrap;
    transition: left 0.045s linear;
    background-color: #ffa500;
    border-radius: 50% 50% 50% 0%;
}
.range-value-info span{
    width: 40px;
    height: 24px;
    line-height: 5px;
    text-align: center;
    color: #fff;
    font-size: 12px;
    display: block;
    position: absolute;
    left: 50%;
    transform: translate(-50%, 0);
    border-radius: 6px;
}
.range-value-info span:before{
  content: "";
  position: absolute;
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  margin-top: -1px;
}
.variables .title {
  font-family: "Dancing Script", cursive;
  font-size: 3rem;
  color: whitesmoke;
  position: relative;
}

.variables .title::after {
  position: absolute;
  content: "";
  width: 0%;
  height: 4px;
  background-color: whitesmoke;
  left: 50%;
  bottom: -10px;
  transition: all 0.4s ease-in-out;
}

.variables:hover .title::after {
  width: 100%;
  left: 0;
}

.checkboxx_allegro_new{
    display: none;
}

.c-checkbox_new {
  display: none;
}
.c-checkbox{
    display: none;
}

.c-formContainer,
.c-form,
.c-form__toggle_allegro {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer {
  position: relative;
  font-weight: 700;
}

.c-form,
.c-form__toggle_allegro {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form {

  padding: 0.625em;
  box-sizing: border-box;
  display: flex;
  justify-content: center;
}

.c-form__toggle_allegro {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_allegro::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_allegro,
.c-form__button {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_allegro,
.c-form__buttonLabel {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_allegro {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_allegro::placeholder {
  color: currentColor;
}
.c-form__input_allegro:required:valid {
  color: #3a3a3a;
}
.c-form__input_allegro:required:valid + .c-form__buttonLabel {
  color: #ffffff;
}
.c-form__input_allegro:required:valid + .c-form__buttonLabel::before {
  pointer-events: initial;
}

.c-form__buttonLabel {
  color: #ffaea9;
  height: 100%;
  width: auto;
}
.c-form__buttonLabel::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  pointer-events: none;
  cursor: pointer;
}

.c-form__button {
  color: inherit;
  padding: 0;
  height: 100%;
  width: 5em;
  background-color: #ff7b73;
}
.c-checkbox:checked + .c-formContainer .c-form {
  width: 37.5em;
}
.c-checkbox:checked + .c-formContainer .c-form__toggle_allegro {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox:checked + .c-formContainer .c-form__input_allegro,
.c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-checkbox_new:checked + .c-formContainer_new .c-form_new {
  width: 37.5em;
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__toggle_allegro_new {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__input_allegro_new,
.c-checkbox_new:checked + .c-formContainer_new .c-form__buttonLabel_new {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-formContainer_new,
.c-form_new,
.c-form__toggle_allegro_new {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer_new {
  position: relative;
  font-weight: 700;
}

.c-form_new,
.c-form__toggle_allegro_new {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form_new {

  padding: 0.625em;
  box-sizing: border-box;
  display: flex;
  justify-content: center;
}

.c-form__toggle_allegro_new {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_allegro_new::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_allegro_new,
.c-form__button_new {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_allegro_new,
.c-form__buttonLabel_new {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_allegro_new {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_allegro_new::placeholder {
  color: currentColor;
}
.c-form__input_allegro_new:required:valid {
  color: #3a3a3a;
}
.c-form__input_allegro_new:required:valid + .c-form__buttonLabel_new {
  color: #ffffff;
}
.c-form__input_allegro_new:required:valid + .c-form__buttonLabel_new::before {
  pointer-events: initial;
}

.c-form__buttonLabel_new {
  color: #ffaea9;
  height: 100%;
  width: auto;
}
.c-form__buttonLabel_new::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  pointer-events: none;
  cursor: pointer;
}

.c-form__button_new {
  color: inherit;
  padding: 0;
  height: 100%;
  width: 5em;
  background-color: #ff7b73;
}


.checkboxx_olx_new{
    display: none;
}



.c-formContainer,
.c-form,
.c-form__toggle_olx {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer {
  position: relative;
  font-weight: 700;
}

.c-form,
.c-form__toggle_olx {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_olx {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_olx::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_olx,
.c-form__button {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_olx,
.c-form__buttonLabel {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_olx {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_olx::placeholder {
  color: currentColor;
}
.c-form__input_olx:required:valid {
  color: #3a3a3a;
}
.c-form__input_olx:required:valid + .c-form__buttonLabel {
  color: #ffffff;
}
.c-form__input_olx:required:valid + .c-form__buttonLabel::before {
  pointer-events: initial;
}


.c-checkbox:checked + .c-formContainer .c-form__toggle_olx {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox:checked + .c-formContainer .c-form__input_olx,
.c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}


.c-checkbox_new:checked + .c-formContainer_new .c-form__toggle_olx_new {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__input_olx_new,
.c-checkbox_new:checked + .c-formContainer_new .c-form__buttonLabel_new {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-formContainer_new,
.c-form_new,
.c-form__toggle_olx_new {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-form_new,
.c-form__toggle_olx_new {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_olx_new {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_olx_new::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_olx_new,
.c-form__button_new {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_olx_new,
.c-form__buttonLabel_new {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_olx_new {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_olx_new::placeholder {
  color: currentColor;
}
.c-form__input_olx_new:required:valid {
  color: #3a3a3a;
}
.c-form__input_olx_new:required:valid + .c-form__buttonLabel_new {
  color: #ffffff;
}
.c-form__input_olx_new:required:valid + .c-form__buttonLabel_new::before {
  pointer-events: initial;
}






.checkboxx_erli_new{
    display: none;
}



.c-formContainer,
.c-form,
.c-form__toggle_erli {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer {
  position: relative;
  font-weight: 700;
}

.c-form,
.c-form__toggle_erli {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_erli {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_erli::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_erli,
.c-form__button {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_erli,
.c-form__buttonLabel {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_erli {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_erli::placeholder {
  color: currentColor;
}
.c-form__input_erli:required:valid {
  color: #3a3a3a;
}
.c-form__input_erli:required:valid + .c-form__buttonLabel {
  color: #ffffff;
}
.c-form__input_erli:required:valid + .c-form__buttonLabel::before {
  pointer-events: initial;
}


.c-checkbox:checked + .c-formContainer .c-form__toggle_erli {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox:checked + .c-formContainer .c-form__input_erli,
.c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}


.c-checkbox_new:checked + .c-formContainer_new .c-form__toggle_erli_new {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__input_erli_new,
.c-checkbox_new:checked + .c-formContainer_new .c-form__buttonLabel_new {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-formContainer_new,
.c-form_new,
.c-form__toggle_erli_new {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-form_new,
.c-form__toggle_erli_new {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_erli_new {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_erli_new::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_erli_new,
.c-form__button_new {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_erli_new,
.c-form__buttonLabel_new {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_erli_new {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_erli_new::placeholder {
  color: currentColor;
}
.c-form__input_erli_new:required:valid {
  color: #3a3a3a;
}
.c-form__input_erli_new:required:valid + .c-form__buttonLabel_new {
  color: #ffffff;
}
.c-form__input_erli_new:required:valid + .c-form__buttonLabel_new::before {
  pointer-events: initial;
}



.checkboxx_alione_new{
    display: none;
}


.c-formContainer,
.c-form,
.c-form__toggle_alione {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer {
  position: relative;
  font-weight: 700;
}

.c-form,
.c-form__toggle_alione {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_alione {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_alione::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_alione,
.c-form__button {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_alione,
.c-form__buttonLabel {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_alione {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_alione::placeholder {
  color: currentColor;
}
.c-form__input_alione:required:valid {
  color: #3a3a3a;
}
.c-form__input_alione:required:valid + .c-form__buttonLabel {
  color: #ffffff;
}
.c-form__input_alione:required:valid + .c-form__buttonLabel::before {
  pointer-events: initial;
}


.c-checkbox:checked + .c-formContainer .c-form__toggle_alione {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox:checked + .c-formContainer .c-form__input_alione,
.c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}


.c-checkbox_new:checked + .c-formContainer_new .c-form__toggle_alione_new {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__input_alione_new,
.c-checkbox_new:checked + .c-formContainer_new .c-form__buttonLabel_new {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-formContainer_new,
.c-form_new,
.c-form__toggle_alione_new {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-form_new,
.c-form__toggle_alione_new {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_alione_new {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_alione_new::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_alione_new,
.c-form__button_new {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_alione_new,
.c-form__buttonLabel_new {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_alione_new {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_alione_new::placeholder {
  color: currentColor;
}
.c-form__input_alione_new:required:valid {
  color: #3a3a3a;
}
.c-form__input_alione_new:required:valid + .c-form__buttonLabel_new {
  color: #ffffff;
}
.c-form__input_alione_new:required:valid + .c-form__buttonLabel_new::before {
  pointer-events: initial;
}




.checkboxx_sprzedajemy_new{
    display: none;
}


.c-formContainer,
.c-form,
.c-form__toggle_sprzedajemy {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer {
  position: relative;
  font-weight: 700;
}

.c-form,
.c-form__toggle_sprzedajemy {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_sprzedajemy {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_sprzedajemy::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_sprzedajemy,
.c-form__button {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_sprzedajemy,
.c-form__buttonLabel {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_sprzedajemy {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_sprzedajemy::placeholder {
  color: currentColor;
}
.c-form__input_sprzedajemy:required:valid {
  color: #3a3a3a;
}
.c-form__input_sprzedajemy:required:valid + .c-form__buttonLabel {
  color: #ffffff;
}
.c-form__input_sprzedajemy:required:valid + .c-form__buttonLabel::before {
  pointer-events: initial;
}


.c-checkbox:checked + .c-formContainer .c-form__toggle_sprzedajemy {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox:checked + .c-formContainer .c-form__input_sprzedajemy,
.c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}


.c-checkbox_new:checked + .c-formContainer_new .c-form__toggle_sprzedajemy_new {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__input_sprzedajemy_new,
.c-checkbox_new:checked + .c-formContainer_new .c-form__buttonLabel_new {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-formContainer_new,
.c-form_new,
.c-form__toggle_sprzedajemy_new {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-form_new,
.c-form__toggle_sprzedajemy_new {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_sprzedajemy_new {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_sprzedajemy_new::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_sprzedajemy_new,
.c-form__button_new {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_sprzedajemy_new,
.c-form__buttonLabel_new {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_sprzedajemy_new {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_sprzedajemy_new::placeholder {
  color: currentColor;
}
.c-form__input_sprzedajemy_new:required:valid {
  color: #3a3a3a;
}
.c-form__input_sprzedajemy_new:required:valid + .c-form__buttonLabel_new {
  color: #ffffff;
}
.c-form__input_sprzedajemy_new:required:valid + .c-form__buttonLabel_new::before {
  pointer-events: initial;
}





.checkboxx_google_new{
    display: none;
}


.c-formContainer,
.c-form,
.c-form__toggle_google {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer {
  position: relative;
  font-weight: 700;
}

.c-form,
.c-form__toggle_google {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_google {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_google::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_google,
.c-form__button {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_google,
.c-form__buttonLabel {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_google {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_google::placeholder {
  color: currentColor;
}
.c-form__input_google:required:valid {
  color: #3a3a3a;
}
.c-form__input_google:required:valid + .c-form__buttonLabel {
  color: #ffffff;
}
.c-form__input_google:required:valid + .c-form__buttonLabel::before {
  pointer-events: initial;
}


.c-checkbox:checked + .c-formContainer .c-form__toggle_google {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox:checked + .c-formContainer .c-form__input_google,
.c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}


.c-checkbox_new:checked + .c-formContainer_new .c-form__toggle_google_new {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__input_google_new,
.c-checkbox_new:checked + .c-formContainer_new .c-form__buttonLabel_new {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-formContainer_new,
.c-form_new,
.c-form__toggle_google_new {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-form_new,
.c-form__toggle_google_new {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_google_new {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_google_new::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_google_new,
.c-form__button_new {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_google_new,
.c-form__buttonLabel_new {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_google_new {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_google_new::placeholder {
  color: currentColor;
}
.c-form__input_google_new:required:valid {
  color: #3a3a3a;
}
.c-form__input_google_new:required:valid + .c-form__buttonLabel_new {
  color: #ffffff;
}
.c-form__input_google_new:required:valid + .c-form__buttonLabel_new::before {
  pointer-events: initial;
}



.checkboxx_fb_marketplace_new{
    display: none;
}

.c-formContainer,
.c-form,
.c-form__toggle_fb_marketplace {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer {
  position: relative;
  font-weight: 700;
}

.c-form,
.c-form__toggle_fb_marketplace {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_fb_marketplace {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_fb_marketplace::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_fb_marketplace,
.c-form__button {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_fb_marketplace,
.c-form__buttonLabel {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_fb_marketplace {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_fb_marketplace::placeholder {
  color: currentColor;
}
.c-form__input_fb_marketplace:required:valid {
  color: #3a3a3a;
}
.c-form__input_fb_marketplace:required:valid + .c-form__buttonLabel {
  color: #ffffff;
}
.c-form__input_fb_marketplace:required:valid + .c-form__buttonLabel::before {
  pointer-events: initial;
}


.c-checkbox:checked + .c-formContainer .c-form__toggle_fb_marketplace {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox:checked + .c-formContainer .c-form__input_fb_marketplace,
.c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}


.c-checkbox_new:checked + .c-formContainer_new .c-form__toggle_fb_marketplace_new {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__input_fb_marketplace_new,
.c-checkbox_new:checked + .c-formContainer_new .c-form__buttonLabel_new {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-formContainer_new,
.c-form_new,
.c-form__toggle_fb_marketplace_new {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-form_new,
.c-form__toggle_fb_marketplace_new {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_fb_marketplace_new {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_fb_marketplace_new::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_fb_marketplace_new,
.c-form__button_new {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_fb_marketplace_new,
.c-form__buttonLabel_new {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_fb_marketplace_new {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_fb_marketplace_new::placeholder {
  color: currentColor;
}
.c-form__input_fb_marketplace_new:required:valid {
  color: #3a3a3a;
}
.c-form__input_fb_marketplace_new:required:valid + .c-form__buttonLabel_new {
  color: #ffffff;
}
.c-form__input_fb_marketplace_new:required:valid + .c-form__buttonLabel_new::before {
  pointer-events: initial;
}



.checkboxx_pinterest_new{
    display: none;
}


.c-formContainer,
.c-form,
.c-form__toggle_pinterest {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer {
  position: relative;
  font-weight: 700;
}

.c-form,
.c-form__toggle_pinterest {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_pinterest {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_pinterest::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_pinterest,
.c-form__button {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_pinterest,
.c-form__buttonLabel {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_pinterest {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_pinterest::placeholder {
  color: currentColor;
}
.c-form__input_pinterest:required:valid {
  color: #3a3a3a;
}
.c-form__input_pinterest:required:valid + .c-form__buttonLabel {
  color: #ffffff;
}
.c-form__input_pinterest:required:valid + .c-form__buttonLabel::before {
  pointer-events: initial;
}


.c-checkbox:checked + .c-formContainer .c-form__toggle_pinterest {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox:checked + .c-formContainer .c-form__input_pinterest,
.c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}


.c-checkbox_new:checked + .c-formContainer_new .c-form__toggle_pinterest_new {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__input_pinterest_new,
.c-checkbox_new:checked + .c-formContainer_new .c-form__buttonLabel_new {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-formContainer_new,
.c-form_new,
.c-form__toggle_pinterest_new {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-form_new,
.c-form__toggle_pinterest_new {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_pinterest_new {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_pinterest_new::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_pinterest_new,
.c-form__button_new {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_pinterest_new,
.c-form__buttonLabel_new {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_pinterest_new {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_pinterest_new::placeholder {
  color: currentColor;
}
.c-form__input_pinterest_new:required:valid {
  color: #3a3a3a;
}
.c-form__input_pinterest_new:required:valid + .c-form__buttonLabel_new {
  color: #ffffff;
}
.c-form__input_pinterest_new:required:valid + .c-form__buttonLabel_new::before {
  pointer-events: initial;
}



.checkboxx_shopee_new{
    display: none;
}


.c-formContainer,
.c-form,
.c-form__toggle_shopee {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-formContainer {
  position: relative;
  font-weight: 700;
}

.c-form,
.c-form__toggle_shopee {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_shopee {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_shopee::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_shopee,
.c-form__button {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_shopee,
.c-form__buttonLabel {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_shopee {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_shopee::placeholder {
  color: currentColor;
}
.c-form__input_shopee:required:valid {
  color: #3a3a3a;
}
.c-form__input_shopee:required:valid + .c-form__buttonLabel {
  color: #ffffff;
}
.c-form__input_shopee:required:valid + .c-form__buttonLabel::before {
  pointer-events: initial;
}


.c-checkbox:checked + .c-formContainer .c-form__toggle_shopee {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox:checked + .c-formContainer .c-form__input_shopee,
.c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}


.c-checkbox_new:checked + .c-formContainer_new .c-form__toggle_shopee_new {
  visibility: hidden;
  opacity: 0;
  transform: scale(0.7);
}
.c-checkbox_new:checked + .c-formContainer_new .c-form__input_shopee_new,
.c-checkbox_new:checked + .c-formContainer_new .c-form__buttonLabel_new {
  transition: 0.2s 0.1s;
  visibility: visible;
  opacity: 1;
  transform: scale(1);
}




.c-formContainer_new,
.c-form_new,
.c-form__toggle_shopee_new {
    height: 40px;
    font-size: 8px;
    padding-top: 5px;
}

.c-form_new,
.c-form__toggle_shopee_new {
  position: absolute;
  border-radius: 6.25em;
  transition: 0.2s;
}

.c-form__toggle_shopee_new {
    width: 100px;
    background: orange;
    color: white;
    /* line-height: 0px; */
    height: 30px;
    padding-bottom: 5px;  top: 0;
  cursor: pointer;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.c-form__toggle_shopee_new::before {
  font-size: 1.75em;
  content: attr(data-title);
}

.c-form__input_shopee_new,
.c-form__button_new {
  font: inherit;
  border: 0;
  outline: 0;
  border-radius: 5em;
  box-sizing: border-box;
}

.c-form__input_shopee_new,
.c-form__buttonLabel_new {
  font-size: 1.75em;
  opacity: 0;
  visibility: hidden;
  transform: scale(0.7);
  transition: 0s;
}

.c-form__input_shopee_new {
  color: #ffc65d;
  height: 100%;
  width: 100%;
  padding: 0 0.714em;
  background-color: #f4f4f4;
}
.c-form__input_shopee_new::placeholder {
  color: currentColor;
}
.c-form__input_shopee_new:required:valid {
  color: #3a3a3a;
}
.c-form__input_shopee_new:required:valid + .c-form__buttonLabel_new {
  color: #ffffff;
}
.c-form__input_shopee_new:required:valid + .c-form__buttonLabel_new::before {
  pointer-events: initial;
}











.alertify,
.alertify-show,
.alertify-log {
  -webkit-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -moz-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -ms-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -o-transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  transition: all 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  /* easeOutBack */
}

.alertify-hide {
  -webkit-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -moz-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -ms-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -o-transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  transition: all 250ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  /* easeInBack */
}

.alertify-log-hide {
  -webkit-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -moz-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -ms-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  -o-transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  transition: all 500ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
  /* easeInBack */
}

.alertify-cover {
  position: fixed;
  z-index: 99999;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: white;
  filter: alpha(opacity=0);
  opacity: 0;
}

.alertify-cover-hidden {
  display: none;
}

.alertify {
  position: fixed;
  z-index: 99999;
  top: 50px;
  left: 50%;
  width: 550px;
  margin-left: -275px;
  opacity: 1;
}

.alertify-hidden {
  -webkit-transform: translate(0, -150px);
  -moz-transform: translate(0, -150px);
  -ms-transform: translate(0, -150px);
  -o-transform: translate(0, -150px);
  transform: translate(0, -150px);
  opacity: 0;
  display: none;
}

/* overwrite display: none; for everything except IE6-8 */
:root * > .alertify-hidden {
  display: block;
  visibility: hidden;
}

.alertify-logs {
  position: fixed;
  z-index: 5000;
  bottom: 10px;
  right: 10px;
  width: 300px;
}

.alertify-logs-hidden {
  display: none;
}

.alertify-log {
  display: block;
  margin-top: 10px;
  position: relative;
  right: -300px;
  opacity: 0;
}

.alertify-log-show {
  right: 0;
  opacity: 1;
}

.alertify-log-hide {
  -webkit-transform: translate(300px, 0);
  -moz-transform: translate(300px, 0);
  -ms-transform: translate(300px, 0);
  -o-transform: translate(300px, 0);
  transform: translate(300px, 0);
  opacity: 0;
}

.alertify-dialog {
  padding: 25px;
}

.alertify-resetFocus {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.alertify-inner {
  text-align: center;
}

.alertify-text {
  margin-bottom: 15px;
  width: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  font-size: 100%;
}

.alertify-button,
.alertify-button:hover,
.alertify-button:active,
.alertify-button:visited {
  background: none;
  text-decoration: none;
  border: none;
  /* line-height and font-size for input button */
  line-height: 1.5;
  font-size: 100%;
  display: inline-block;
  cursor: pointer;
  margin-left: 5px;
}

@media only screen and (max-width: 680px) {
  .alertify,
  .alertify-logs {
    width: 90%;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }

  .alertify {
    left: 5%;
    margin: 0;
  }
}
/**
 * Default Look and Feel
 */
.alertify,
.alertify-log {
  font-family: sans-serif;
}

.alertify {
  background: #FFF;
  border: 10px solid #333;
  /* browsers that don't support rgba */
  border: 10px solid rgba(0, 0, 0, 0.7);
  border-radius: 8px;
  box-shadow: 0 3px 3px rgba(0, 0, 0, 0.3);
  -webkit-background-clip: padding;
  /* Safari 4? Chrome 6? */
  -moz-background-clip: padding;
  /* Firefox 3.6 */
  background-clip: padding-box;
  /* Firefox 4, Safari 5, Opera 10, IE 9 */
}

.alertify-text {
  border: 1px solid #CCC;
  padding: 10px;
  border-radius: 4px;
}

.alertify-button {
  border-radius: 4px;
  color: #FFF;
  font-weight: bold;
  padding: 6px 15px;
  text-decoration: none;
  text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.5);
  box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.5);
  background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
  background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
  background-image: -ms-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
  background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
  background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0));
}

.alertify-button:hover,
.alertify-button:focus {
  outline: none;
  background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent);
  background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent);
  background-image: -ms-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent);
  background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0.1), transparent);
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0));
}

.alertify-button:focus {
  box-shadow: 0 0 15px #2B72D5;
}

.alertify-button:active {
  position: relative;
  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
}

.alertify-button-cancel,
.alertify-button-cancel:hover,
.alertify-button-cancel:focus {
  background-color: #FE1A00;
  border: 1px solid #D83526;
}

.alertify-button-ok,
.alertify-button-ok:hover,
.alertify-button-ok:focus {
  background-color: #5CB811;
  border: 1px solid #3B7808;
}

.alertify-log {
  background: #1F1F1F;
  background: rgba(0, 0, 0, 0.9);
  padding: 15px;
  border-radius: 4px;
  color: #FFF;
  text-shadow: -1px -1px 0 rgba(0, 0, 0, 0.5);
}

.alertify-log-error {
  background: #FE1A00;
  background: rgba(254, 26, 0, 0.9);
}

.alertify-log-success {
  background: #5CB811;
  background: rgba(92, 184, 17, 0.9);
}




    .after_url{
        display: none;
        margin-top: 30px;
    }
.css-16vhkgm-placeholder {
    color: rgb(111, 117, 130);
    margin-left: 2px;
    margin-right: 2px;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    box-sizing: border-box;
    font-weight: normal;
    width: 97%;
}
.dLhHCP div:last-child {
    margin-bottom: unset;
}
.css-1hwfws3 {
    -webkit-box-align: center;
    align-items: center;
    display: flex;
    flex: 1 1 0%;
    flex-wrap: wrap;
    padding: 2px 8px;
    position: relative;
    overflow: hidden;
    box-sizing: border-box;
}
.css-1g6gooi {
    margin: 2px;
    padding-bottom: 2px;
    padding-top: 2px;
    visibility: visible;
    color: rgb(51, 51, 51);
    box-sizing: border-box;
}
.kkFYhG {
    background: none;
    color: inherit;
    border: none;
    padding: 0px;
    font: inherit;
    cursor: pointer;
    outline: inherit;
    width: 100%;
}
.gLYyPe {
    border: 0px;
    clip: rect(0px, 0px, 0px, 0px);
    clip-path: inset(50%);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0px;
    position: absolute;
    white-space: nowrap;
    width: 1px;
    transition: all 300ms ease-out 0s;
}
.dKCUmk {
    font-size: 10px;
    line-height: 14px;
    font-weight: 500;
    color: rgb(111, 117, 130);
    text-align: left;
    margin-bottom: 0px;
}
.bMpfhh {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: start;
    justify-content: flex-start;
}
.flPgJW {
    font-size: 12px;
    line-height: 16px;
    font-weight: bold;
    color: rgb(34, 41, 57);
    margin-bottom: 0px;
}

.bMpfhh .country-flag {
    width: 15px;
    border-radius: 2px;
    margin: 0px 8px 0px 4px;
}

.mlPNl {
    font-size: 12px;
    line-height: 16px;
    font-weight: normal;
    color: rgb(111, 117, 130);
    margin-bottom: 0px;
}
.dqHGKV {
    border-radius: 50px;
    margin-left: 8px;
    background-color: rgb(244, 245, 248);
    padding: 5px;
}
.ilxWoB {
    width: calc(100% - 16px);
    padding: 8px 8px 7px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    margin: auto;
    background-color: transparent;
}
.bMpfhh {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: start;
    justify-content: flex-start;
}

.hmWAub .dropdown-wrap {
    z-index: 20;
}
.bDJZpd {
    position: absolute;
    box-sizing: border-box;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    height: 66px;
    margin-top: -66px;
    background-color: rgb(255, 255, 255);
    z-index: 10;
    width: 100%;
    border-radius: 8px;
    bottom: 0px;
}
.kgpauv {
    visibility: hidden;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
}
.dQUKSz {
    font-weight: bold;
    line-height: 24px;
    letter-spacing: 0.2px;
    background-color: rgb(255, 255, 255);
    color: rgb(204, 210, 225);
    padding: 8px 16px;
}
.dQUKSz button {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    font-size: 12px;
    line-height: 14px;
}
.cGrIMx {
    border: 1px solid rgb(255 165 0);
    border-radius: 4px;
    font-weight: bold;
    line-height: 1.71;
    letter-spacing: 0.2px;
    transition: background-color 0.3s ease-in-out 0s;
    background-color: rgb(255 165 0);
    color: rgb(255, 255, 255);
    font-size: 14px;
    padding: 8px 16px;
}
.dQUKSz .add-span {
    font-size: 17px;
    line-height: 20px;
    margin-right: 5px;
}
.itxFvb {
    position: relative;
    box-sizing: border-box;
    width: auto;
    height: 32px;
    border-radius: 16px;
    margin-bottom: 16px;
    margin-left: 16px;
    margin-right: 0px;
    align-self: flex-end;
    box-shadow: rgb(0 0 0 / 12%) 0px 2px 7px 0px;
    display: flex;
    flex-wrap: wrap;
}
.idcTut {
    font-size: 12px;
    height: 0px;
    width: 0px;
    background-color: rgb(255, 255, 255);
    border-radius: 16px 16px 0px 0px;
    padding: 0px 0px 15px;
    margin-bottom: 0px;
    text-align: left;
    transform: scale(0);
    transform-origin: left bottom;
}
.bgRJyM {
    position: absolute;
    bottom: 0px;
    left: 0px;
    box-sizing: border-box;
    width: 32px;
    max-height: 32px;
    display: inline-block;
    background-color: rgb(255, 255, 255);
    padding: 8px;
    border-radius: 16px;
}
.jcoaWw {
    color: rgb(33, 84, 61);
    font-size: 12px;
    line-height: 16px;
    letter-spacing: 0px;
    margin-bottom: 0px;
    display: inline-block;
    background-color: rgb(255, 255, 255);
    padding: 8px 8px 8px 32px;
    border-radius: 16px;
}

.hoWDdh {
    color: rgb(0, 0, 0);
    border: 1px solid rgb(230, 232, 240);
    background-color: rgb(255, 255, 255);
    padding: 16px 24px;
    font-size: 14px;
    margin-left: 24px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
}

.hoWDdh img {
    margin-right: 6px;
}
.hoWDdh p {
    margin-bottom: 0px;
    white-space: nowrap;
}

.dCFMRk button img {
    margin-right: 4px;
}

.hoWDdh img {
    margin-right: 6px;
}

.loading-overlay {
display: none;
}


.pagination{
        justify-content: center;
        font-size:  19px;
        width: 100%;
}
.pagination_none{
        justify-content: center;
        font-size:  19px;
        width: 100%;
}
.pagination b {
        font-size: 25px;
    margin-top: -6px;
}
.pagination a {
        color: #ffbc00;
}
.pagination a:hover {
        color: #ffbc00;
}

.blur{
    -webkit-filter: blur(5px);
  -moz-filter: blur(5px);
  -o-filter: blur(5px);
  -ms-filter: blur(5px);
  filter: blur(5px);
}
.dboBku .rectangle{
        width: 45px !important;
    height: 17px;
    border-radius: 5px;
    margin: 4px 4px;
}
.dboBku .circle{
        width: 35px !important;
    height: 35px;
    border-radius: 5px;
    margin: 0px 4px;
}
.need_to_update{
        background: #ffc80052;
}
.added{
    background: #1bff0052;
}
.important{
      -moz-transition:all 1.5s ease-in-out;
    -webkit-transition:all 1.5s ease-in-out;
    -o-transition:all 1.5s ease-in-out;
    -ms-transition:all 1.5s ease-in-out;
    transition:all 1.5s ease-in-out;
    -moz-animation:blink_important normal 3.5s infinite ease-in-out;
    /* Firefox */
    -webkit-animation:blink_important normal 3.5s infinite ease-in-out;
    /* Webkit */
    -ms-animation:blink_important normal 3.5s infinite ease-in-out;
    /* IE */
    animation:blink_important normal 3.5s infinite ease-in-out;
    /* Opera */
    background: #fffe0052;

}
.warning{
  background: #ff00007a;
      -moz-transition:all 1.5s ease-in-out;
    -webkit-transition:all 1.5s ease-in-out;
    -o-transition:all 1.5s ease-in-out;
    -ms-transition:all 1.5s ease-in-out;
    transition:all 1.5s ease-in-out;
    -moz-animation:blink_warning normal 3.5s infinite ease-in-out;
    /* Firefox */
    -webkit-animation:blink_warning normal 3.5s infinite ease-in-out;
    /* Webkit */
    -ms-animation:blink_warning normal 3.5s infinite ease-in-out;
    /* IE */
    animation:blink_warning normal 3.5s infinite ease-in-out;
    /* Opera */
}
@keyframes blink_warning {
    0% {
           background-color: rgba(255,0,0,0.5)
    }
    50% {
           background-color: rgba(255,0,0,0)
    }
    100% {
           background-color: rgba(255,0,0,0.5)
    }
}
@-webkit-keyframes blink_warning {
    0% {
           background-color: rgba(255,0,0,0.5)
    }
    50% {
           background-color: rgba(255,0,0,0)
    }
    100% {
           background-color: rgba(255,0,0,0.5)
    }
}
@keyframes blink_important {
    0% {
           background-color: rgba(255,254,0,0.5)
    }
    50% {
           background-color: rgba(255,254,0,0)
    }
    100% {
           background-color: rgba(255,254,0,0.5)
    }
}
@-webkit-keyframes blink_important {
    0% {
           background-color: rgba(255,254,0,0.5)
    }
    50% {
           background-color: rgba(255,254,0,0)
    }
    100% {
           background-color: rgba(255,254,0,0.5)
    }
}
.waiting_to_add{
    background: #f1f1f152
}
.addProductModal{
    display: none;
}
.addProductModal .addProductModal__Overlay, .addProductModal__Overlay--clean {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1031;
    overflow: auto;
    text-align: center;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    opacity: 1;
}
.addProductModal .addProductModal__Overlay {
    -ms-flex-align: center;
    align-items: center;
}
.addProductModal__Overlay__light {
    background-color: hsla(0,0%,100%,.96);
}
.ReactModal__Overlay--after-open {
    opacity: 1;
}
.ReactModal__Overlay {
    opacity: 0;
    -webkit-transition: opacity .3s ease-in-out;
    -o-transition: opacity .3s ease-in-out;
    transition: opacity .3s ease-in-out;
}
.addProductModal .addProductModal__Content {
    padding: 24px;
    margin: 24px;
    border-radius: 8px;
    -webkit-box-shadow: 0 4px 20px 0 rgb(34 41 57 / 15%);
    box-shadow: 0 4px 20px 0 rgb(34 41 57 / 15%);
    background-color: #fff;
    outline: none;
    display: inline-block;
    min-height: 660px;
}


.ProductInfoModal{
    display: none;
}
.ProductInfoModal .addProductModal__Overlay, .addProductModal__Overlay--clean {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1031;
    overflow: auto;
    text-align: center;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    opacity: 1;
}
.ProductInfoModal .addProductModal__Overlay {
    -ms-flex-align: center;
    align-items: center;
}

.ProductInfoModal .addProductModal__Content {
    padding: 24px;
    margin: 24px;
    border-radius: 8px;
    -webkit-box-shadow: 0 4px 20px 0 rgb(34 41 57 / 15%);
    box-shadow: 0 4px 20px 0 rgb(34 41 57 / 15%);
    background-color: #fff;
    outline: none;
    display: inline-block;
    min-height: 660px;
}


.hauPWX {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    box-shadow: rgb(34 41 57 / 10%) 0px 2px 8px 0px;
    background-color: rgb(255, 255, 255);
    font-size: 18px;
    font-weight: bold;
    line-height: 1.33;
    color: rgb(34, 41, 57);
    height: 100%;
    width: 950px;
    padding: 16px 24px;
    margin: -24px -24px 16px;
    text-align: left;
    border-bottom-left-radius: unset;
    border-bottom-right-radius: unset;
    height: 53px;
}
.kLGAUF {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    justify-content: space-between;
    width: 100%;
}
.dLhHCP {
    height: 634px;
    width: 950px;
    overflow-y: auto;
    margin: -16px -24px;
    padding: 24px;
}
.gdYlRc {
    border-top-left-radius: unset;
    border-top-right-radius: unset;
    margin-bottom: -24px;
    margin-top: 16px;
    display: flex;
    width: 950px;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    justify-content: space-between;
    height: auto;
    box-shadow: rgb(34 41 57 / 10%) 0px 0px 8px 2px;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}
.rWXjW {
    border-radius: 4px;
    font-weight: bold;
    line-height: 1.71;
    letter-spacing: 0.2px;
    transition: background-color 0.3s ease-in-out 0s;
    border: unset;
    background-color: transparent;
    color: rgb(111, 117, 130);
    font-size: 12px;
    padding: 0px;
}

.dTYzCa {
    border-radius: 4px;
    border: 1px solid rgb(230, 232, 240);
    text-align: left;
    padding: 16px;
}
.dLhHCP > * {
    margin-bottom: 16px;
}
.fdrCFp {
    font-size: 16px;
    font-weight: bold;
    line-height: 1;
    color: rgb(34, 41, 57);
    text-align: left;
    margin-bottom: 21px;
}
.dLhHCP div:last-child {
    margin-bottom: unset;
}
.bmHJSZ {
    width: 100%;
}
.kfmEjW {
    font-size: 14px;
    font-weight: 500;
    line-height: 1.14;
    color: rgb(34, 41, 57);
    text-align: left;
    margin-bottom: 8px;
}
.jKzXml {
    font-size: 12px;
    font-weight: 500;
    line-height: 1.33;
    color: rgb(111, 117, 130);
    margin-top: 4px;
    margin-bottom: 12px;
}
.eqUDzr {
    display: inline-block;
}
.AEgKY {
    display: inline-flex;
    padding: 5px 10px 5px 0px;
    position: relative;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.14;
    color: rgb(34, 41, 57);
}
.gLYyPe:checked + .sc-jIZahH {
    background-color: rgb(255 165 0);
    border-color: rgb(255 141 0);
}
.jLcNAu {
    display: inline-block;
    position: relative;
    border: 1px solid rgb(204, 210, 225);
    width: 16px;
    height: 16px;
    left: 0px;
    border-radius: 50%;
    margin-right: 8px;
    vertical-align: middle;
    transition: all 300ms ease 0s;
    background-color: white;
    cursor: pointer;
}
.gLYyPe:checked + .sc-jIZahH::after {
    width: 6px;
    height: 6px;
    opacity: 1;
    left: 30%;
    top: 30%;
}
.jLcNAu::after {
    content: "";
    display: block;
    width: 0px;
    height: 0px;
    border-radius: 50%;
    background-color: orange;
    opacity: 0;
    left: 50%;
    top: 50%;
    position: absolute;
}
.fdrCFp {
    font-size: 16px;
    font-weight: bold;
    line-height: 1;
    color: rgb(34, 41, 57);
    text-align: left;
    margin-bottom: 21px;
}
.dTYzCa {
    border-radius: 4px;
    border: 1px solid rgb(230, 232, 240);
    text-align: left;
    padding: 16px;
}
.bZVMxs {
    margin-right: 27px;
}
.zjuFW {
    border-radius: 100px;
    background-color: rgb(244, 245, 248);
    position: relative;
    width: 240px;
    padding: 10px 16px;
}
.dLhHCP div:last-child {
    margin-bottom: unset;
}
.dbAQuZ {
    width: 100%;
    height: 4px;
    border-radius: 2px;
    background-color: rgb(255 165 0);
}

.fVPndb {
    width: 16px;
    height: 16px;
    border-radius: 100px;
    box-shadow: rgb(34 41 57 / 10%) 0px 2px 4px 0px;
    background-color: rgb(255 165 0);
    z-index: 0 !important;
}
.dMXXiq {
    display: flex;
    -webkit-box-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    align-items: center;
    width: 240px;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.14;
    color: rgb(34, 41, 57);
    margin-top: 8px;
}

.kfmEjW {
    font-size: 14px;
    font-weight: 500;
    line-height: 1.14;
    color: rgb(34, 41, 57);
    text-align: left;
    margin-bottom: 8px;
}
.jKzXml {
    font-size: 12px;
    font-weight: 500;
    line-height: 1.33;
    color: rgb(111, 117, 130);
    margin-top: 4px;
    margin-bottom: 12px;
}


.dvQMyw {
    background-color: rgb(244, 245, 248);
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    cursor: pointer;
}
.dvQMyw img {
    height: 12px;
    width: 12px;
    opacity: 0.5;
}

/*Chrome*/
@media screen and (-webkit-min-device-pixel-ratio:0) {
    input[type='range'] {
      overflow: hidden;
      width: 100%;
      -webkit-appearance: none;
      background-color: lightgrey;
      border-radius:50px;
        height: 25px;
        margin-right: 10px;
    }
    
    input[type='range']::-webkit-slider-runnable-track {
      height: 25px;
      -webkit-appearance: none;
      color: red;
      border-radius:90px;
    }
    
    input[type='range']::-webkit-slider-thumb {
      width: 25px;
      -webkit-appearance: none;
      height: 25px;
      cursor: ew-resize;
      background: white;
      border-radius:20px;
      border: 6px solid #ffa500;
      box-shadow: -275px 0 0 260px #ffa500, 0px 0 0 0 #ffa500;
      
    }

}
/** FF*/
input[type="range"]::-moz-range-progress {
background: linear-gradient(to right, rgb(204, 210, 225) 0%, rgb(204, 210, 225) 0%, rgb(255, 165, 0) 0%, rgb(255, 212, 2) 100%, rgb(204, 210, 225) 100%, rgb(204, 210, 225) 100%);
}
input[type="range"]::-moz-range-track {  
  background-color: #9a905d;
}
/* IE*/
input[type="range"]::-ms-fill-lower {
background: linear-gradient(to right, rgb(204, 210, 225) 0%, rgb(204, 210, 225) 0%, rgb(255, 165, 0) 0%, rgb(255, 212, 2) 100%, rgb(204, 210, 225) 100%, rgb(204, 210, 225) 100%);
}
input[type="range"]::-ms-fill-upper {  
  background-color: #9a905d;
}





/*******    The wrapper for the range input    *******/
.range-box {
  position: relative;
  background-color: #f4f4f4;
  padding: 0;
  margin: 0 35px;
  overflow: visible;
  padding-left: 15px;
  padding-right: 15px;
    padding-top: 8px;
    padding-bottom: 10px;

}
.range-box:after {
  display: block;
  position: absolute;
  bottom: 0;
  left: 0;
  content: "";
  width: 100%;
  background-color: #b3b3b3;
  height: 4px;
}
.range-box .legend-min {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: bold;
    font-size: 14px;
    color: #202020;
    margin-top: 14px;
    float: left;
}
.range-box .legend-max {
    font-family: Helvetica, Arial, sans-serif;
    font-weight: bold;
    font-size: 14px;
    color: #202020;
    margin-top: 14px;
    float: right;
}

/*******    Extra controls on the side    *******/
.no-selection, .control-plus, .control-minus {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.control-minus-info {
  position: absolute;
  top: 0;
  background-color: #ffa500;
  color: white;
  width: 35px;
  text-align: center;
  cursor: pointer;
  height: 43px;
  border-bottom: 4px solid #d58a00;
  z-index: 1;
  font-weight: bold;
  font-size: 35px;
  line-height: 35px;
  left: -35px;
  line-height: 31px;
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
.control-minus-info:hover {
  top: 1px;
  background-color: #ffb224;
  border-bottom-width: 3px;
}
.control-minus-info:active {
  top: 3px;
  background-color: #ffbd44;
  border-bottom-width: 2px;
}

.control-plus-info {
  position: absolute;
  top: 0;
  background-color: #ffa500;
  color: white;
  width: 35px;
  text-align: center;
  cursor: pointer;
  height: 43px;
  border-bottom: 4px solid #d58a00;
  z-index: 1;
  font-weight: bold;
  font-size: 35px;
  line-height: 35px;
  right: -35px;
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
.control-plus-info:hover {
  top: 1px;
  background-color: #ffb224;
  border-bottom-width: 3px;
}
.control-plus-info:active {
  top: 3px;
  background-color: #ffbd44;
  border-bottom-width: 2px;
}
.control-minus {
  position: absolute;
  top: 0;
  background-color: #ffa500;
  color: white;
  width: 35px;
  text-align: center;
  cursor: pointer;
  height: 43px;
  border-bottom: 4px solid #d58a00;
  z-index: 1;
  font-weight: bold;
  font-size: 35px;
  line-height: 35px;
  left: -35px;
  line-height: 31px;
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
.control-minus:hover {
  top: 1px;
  background-color: #ffb224;
  border-bottom-width: 3px;
}
.control-minus:active {
  top: 3px;
  background-color: #ffbd44;
  border-bottom-width: 2px;
}

.control-plus {
  position: absolute;
  top: 0;
  background-color: #ffa500;
  color: white;
  width: 35px;
  text-align: center;
  cursor: pointer;
  height: 43px;
  border-bottom: 4px solid #d58a00;
  z-index: 1;
  font-weight: bold;
  font-size: 35px;
  line-height: 35px;
  right: -35px;
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
.control-plus:hover {
  top: 1px;
  background-color: #ffb224;
  border-bottom-width: 3px;
}
.control-plus:active {
  top: 3px;
  background-color: #ffbd44;
  border-bottom-width: 2px;
}

/*******    Value tooltip    *******/
.current-value {
  visibility: hidden;
  background: #009fdf;
  border-radius: 3px;
  position: absolute;
  top: -78px;
  padding: 3px 3px;
  padding-top: 25px;
  padding-bottom: 25px;
  width: 75px;
  font-family: Helvetica, Arial, sans-serif;
  font-size: 17px;
  font-weight: bold;
  color: white;
  margin-left: 11%;
  text-align: center;
  line-height: 22px;
  white-space: nowrap;
  transition: left 0.045s linear;
  background-color: #ffa500;
    border-radius: 50% 50% 50% 0%;

}
.current-value:after {

}

.current-value-info {
  visibility: hidden;
  background: #009fdf;
  border-radius: 3px;
  position: absolute;
  top: -78px;
  padding: 3px 3px;
  padding-top: 25px;
  padding-bottom: 25px;
  width: 75px;
  font-family: Helvetica, Arial, sans-serif;
  font-size: 17px;
  font-weight: bold;
  color: white;
  margin-left: 11%;
  text-align: center;
  line-height: 22px;
  white-space: nowrap;
  transition: left 0.045s linear;
  background-color: #ffa500;
    border-radius: 50% 50% 50% 0%;

}
.current-value-info:after {

}
.id_product_class{
  color: white;
    position: absolute;
    left: 20px;
    top: 20px;
    font-size: 12px;
    background: #2679ca;
    border-radius: 12px;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 7px;
    padding-right: 7px;
}

</style>
</head>
<?php
$user = $_SESSION["username"];
$sql =
    "SELECT id, username, first_login, products_added, earned, avatar, name FROM users_platform WHERE username='" .
    $user .
    "'";
$result = $conn->query($sql);
if ($result) {
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) { ?>
<body>
<div id="root">
  <div class="container-dash">
    <div class="sc-gemMas kMJAoa">
<!-- SEARCH BAR -->
  <div class="sc-cbDwiu SeMOQ">
    <div class="sc-hZiMVj hqILkp Header__HeaderContent">
        <form class="sc-dDaJoQ dCFMRk">
            <input data-cy="product-search-input" name="keywords" id="keywords" placeholder="Wprowadź tytuł, numer aukcji (np. #328) lub źródło (np. shopee)" class="sc-gKXOVf gIxpNp" value="" onkeyup="searchFilter();" />
            <button type="submit" class="sc-hKMtZM ekGoRi"><img src="https://app.spocket.co/static/media/zoom-icon.8e4310d5.svg" alt="Zoom" />Szukaj</button>
            <ul data-hidden="true" class="sc-ciicml bHapIv"></ul>
        </form>
        <button class="sc-hKMtZM sc-McAUB cBVeEm hoWDdh intercom__advanced-filters-button" id="add_product_modal">
            <p>Dodaj produkt</p>
        </button>
        <div class="hoWDdh cBVeEm" style="cursor: pointer;"><p>Statystyki</p></div>
         <div class="sc-hQikvm dnZMBZ" style="margin-top: 15px; display: inline-flex;">
      <img src="<?php echo $row[
          "avatar"
      ]; ?>" style="border-radius: 50%; margin-left: 25px;"width="125px;" height="65px;"/>
<div style="display: inline-block;     margin-left: 20px;">
  <div  style="display: inline-flex; font-size:15px;"><span><?php echo $row[
      "name"
  ]; ?></span><a href="logout.php"><img src="images/icons/logout.png" width="15px;" height="15px;" style=" cursor: pointer;   margin-left: 42px; margin-top: 4px;" id="logout_button" /></a></div>
   <div style="display: inline-flex; font-size:13px;"><span>Dodano: </span><span style="    margin-left: 3px; margin-right: 3px;"><?php echo $row[
       "products_added"
   ]; ?></span><span> produktów</span></div>
  <div style="display: inline-flex; font-size: 13px;"><span>Zarobiono: </span><span style="    margin-left: 3px; margin-right: 3px;"><?php echo $row[
      "earned"
  ]; ?></span><span> złotych</span></div>

</div>

    </div> 
    </div>

</div>
<!-- CATEGORIES -->
<div>
    <div class="sc-ifyiBu cxCHCs intercom__categories-section" style="height: auto; opacity: 1; visibility: visible;">
        <div class="sc-gVIfzB eepPca">
            <div height="144" width="184" class="sc-IAann kZHthq">

                    <div class="CategoryCard__background-img">
                        <img
                            src="data:image/jpeg;base64,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"
                            alt="Category"
                        />
                    </div>                   <div>Dom i ogród</div>
            </div>
        </div>
        <div class="sc-ddkEoM jUlmMY">
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">

                    <div class="CategoryCard__background-img">
                        <img
                            src="data:image/jpeg;base64,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"
                            alt="Category"
                        />
                    </div>                    <div>Dom i ogród</div>
                </div>
            </div>
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">
                    <div class="CategoryCard__background-img">
                        <img
                            src="data:image/jpeg;base64,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"
                            alt="Category"
                        />
                    </div>
                    <div>Biżuteria i zegarki</div>
                </div>
            </div>
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">
                    <div class="CategoryCard__background-img">
                        <img
                            src="data:image/jpeg;base64,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"
                            alt="Category"
                        />
                    </div>
                    <div>Elektronika</div>
                </div>
            </div>
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">
                    <div class="CategoryCard__background-img">
                        <img
                            src="data:image/jpeg;base64,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"
                            alt="Category"
                        />
                    </div>
                    <div>Dzieci i niemowlęta</div>
                </div>
            </div>
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">
                    <div class="CategoryCard__background-img"><img src="https://app.spocket.co/static/media/category-thumb-toys.449276c9.png" alt="Category" /></div>
                    <div>Zabawki</div>
                </div>
            </div>
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">
                    <div class="CategoryCard__background-img">
                        <img
                            src="data:image/jpeg;base64,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"
                            alt="Category"
                        />
                    </div>
                    <div>Buty</div>
                </div>
            </div>
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">
                    <div class="CategoryCard__background-img">
                        <img
                            src="data:image/jpeg;base64,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"
                            alt="Category"
                        />
                    </div>
                    <div>Zdrowie i uroda</div>
                </div>
            </div>
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">
                    <div class="CategoryCard__background-img">
                        <img
                            src="data:image/jpeg;base64,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"
                            alt="Category"
                        />
                    </div>
                    <div>Zwierzaki</div>
                </div>
            </div>
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">
                                      <div class="CategoryCard__background-img"><img src="https://app.spocket.co/static/media/category-thumb-big-women-clothing.db013778.jpg" alt="Category" /></div>

                    <div>Ubrania</div>
                </div>
            </div>
            <div class="sc-fgiXzq fDqLgK">
                <div class="sc-IAann iavpGv">
                    <div class="CategoryCard__background-img">
                        <img
                            src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAASABIAAD/4QBMRXhpZgAATU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAAdKADAAQAAAABAAAAgAAAAAD/7QA4UGhvdG9zaG9wIDMuMAA4QklNBAQAAAAAAAA4QklNBCUAAAAAABDUHYzZjwCyBOmACZjs+EJ+/8AAEQgAgAB0AwEiAAIRAQMRAf/EAB8AAAEFAQEBAQEBAAAAAAAAAAABAgMEBQYHCAkKC//EALUQAAIBAwMCBAMFBQQEAAABfQECAwAEEQUSITFBBhNRYQcicRQygZGhCCNCscEVUtHwJDNicoIJChYXGBkaJSYnKCkqNDU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6g4SFhoeIiYqSk5SVlpeYmZqio6Slpqeoqaqys7S1tre4ubrCw8TFxsfIycrS09TV1tfY2drh4uPk5ebn6Onq8fLz9PX29/j5+v/EAB8BAAMBAQEBAQEBAQEAAAAAAAABAgMEBQYHCAkKC//EALURAAIBAgQEAwQHBQQEAAECdwABAgMRBAUhMQYSQVEHYXETIjKBCBRCkaGxwQkjM1LwFWJy0QoWJDThJfEXGBkaJicoKSo1Njc4OTpDREVGR0hJSlNUVVZXWFlaY2RlZmdoaWpzdHV2d3h5eoKDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uLj5OXm5+jp6vLz9PX29/j5+v/bAEMAAQEBAQEBAgEBAgMCAgIDBAMDAwMEBQQEBAQEBQYFBQUFBQUGBgYGBgYGBgcHBwcHBwgICAgICQkJCQkJCQkJCf/bAEMBAQEBAgICBAICBAkGBQYJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCQkJCf/dAAQACP/aAAwDAQACEQMRAD8A/v4ooooAKKKKACiiigAooooAKKKKACiiigAoopGOBmgBaKrG4IONv60n2lv7n61fs2Z+0j3P/9D+/iiiigAooooAKKKKAEZlRSznAHJJr5m1n9qPwjpN7M0Ok6peaTbyeXJqkEG613DrtbOSo/vYCnsSKzP2hfiDqdwYvhJ4HO/U9TIS5dekMTckEjoSvLei8dWFes+B/AFnovhq00KVNtpboAIj1kb+KSX1LHnHQdOleVKvVrVJQoNJR3dr69v8zsjThCClUV2+nl3/AMjqPCHjnwp480xdW8KX0d5CQCdh+Zc9mU8j8RXWV8efE39nnVNJuZPHXwKuW0fVIiZTbRHEch6sEB+Ubu6EbT7Gj4XftVaPqN/B4J+KgXSNcb5AzqUhmYcHBPAb2zUrNFTmqWK91vZ/Zfz6ej/Er6k5xc6OqXTqj7DopkckcyCWJgysMgg5BFPr1zhCgjPFFFADDGncUnlx+lSUU7snkXY//9H+/iiiigAooooAKgufP+zSfZcebtOzPTdjjP41PRSaA+Zvgf8ACvU9HvL7x742Rzql9K4jjmwXjTJ3O2CRvlb5vZdo7V9M0UVzYLBww9JUobI2xFeVSbnIK+bPjP8As4+FfihZy3UEawX5ywb+Fm6/gSf154PNfSdFPF4OnXg6dVXQqNedOXNB2Z+Qvgj47fF79mbx9cfDP4pBrvRjIv2DzwRiLaMhJz/FuyQH+Ujjdnk/qF4I+InhX4gacNQ8O3IkIxvib5ZEPoynkVQ+Jvwp8E/Fvw9J4c8aWa3ETqyq+MPHuGCVbqK/LO8+HnxA/Zi+I1v4e03Xor7R5AXtXNwiXtuoIG0ozAugzyG/4Cc9fBiq+ASivep/il/XfT0PVfs8W23pP8H/AF/Vz9k6K+P/AIUftZ+BfFvi66+F+s6jbPrljAty/wBnfepgYqqySbciMlmHysd2CDjFfXsckc0YliYMrDII5BFfQ4fEQqwVSGzPJrUpU5OEtx9FFFbGZ//S/v4ooooAKKKKACiiigAoqKeeC1ha4uXWONBlmYgAD1JPAr5R+K/7ZPwe+HF5B4Y0u/TW/EF9IILWytN0ieYehlmRWSNASMnJPIABJrnxOKp0YudV2RtRoTqPlgrn1Dq+saVoNhJqmtXEdrbRDLySsFUfia+XPiB+1f4U8JaVLraGDT9MjyP7T1eUWtu2P+eUbYll+gCk9ga/Mv8Ab4/4KFaB8ItHg060ltL7xe6MDGR5tnpwHBcIxIlmLAgA5UEcg1/Lf8YP2oPiX8W9en1vXNSur24lY5ubqQySYPZAfljX0VQAOwrxMFjMXjryorkh0b1b9FsZZjiqGE9x+/Pt0Xqz+jP9pj/grj8NrezuNA0bWNX1fflWl01k0u2x/dR5FedwfXygcdGr46/Zt/ag+FP7R/iwfCTw34K+x+Lrqa3vLW5upmuI7qG2uI5LlJryUNJCdoBG4bHPy8EgH8CN099c+deyNK7HJZjk8+5r9Jf+Ca+lXOn/ALRsXiCwBF1Bo2ow2w4ANzeCO1txz1/eShgB/dz2pZ3kFH6pOdVuTS6t/wDDfgZ5LxBiZYmEI2Ub7Jf0z+k34TfAvUNB+K+ufFeS7W5i1G0h0rTYISZB9mhfd5xO1PnlYKAoDAIq/Mc8fqv8OtGv9D8KwWepZExyxUnO3PQVxXwl8K2GmafAsEK+Tp8MdtC/JyY1C559h+de3V7OXYZUMPGiuh1Yut7Wq6jCiiiuswP/0/70/CvifTvFWkxanp8iyCRA+VOQQRww9jVnxD4n8N+EtNbWPFV/b6baJw011KsSAnoNzkDJ7Cvzd8AJ8UtN/wCEp8EwXU8E9hcSJbpbIIZrRPlaPBLDzVlO4k4PQ4IPXi/ip8M/gv8ACH4XXXxv+LqT675cQ1e5GrSyX8kOyKNEWGO5Z1jd34AXALMPfPztfiCyfJTba3++3n8tPWx6ay9J+/L+vwP0Kf45+DL/AEubUvCDHV1hbDGP93GBjJYvJj5B3YAivjr4nf8ABQ34TeBPNh1jxXpsEydbfSlbUZlI6hpR+4U/72K/mV/ae/4KM/Ff48Sf8It4XgTwx4RtiVtdKticEDo8+3CyOevTA6D1r4C1XXdc1c/8TW8kk/2S3A/DpXqUsJiakb1Zcvkv8z5zE5xTg7Uo382f0x+Pf+CxfwhsbyWO2l8Q34HA23ENuD/2zi3AfiR9K5j4Yf8ABXX4O+KvFkWm+INc8ReDfPIjhu7iWO5stzEAC4BV/LU/89NrBe+BzX8zsssIJwN31rG1q6sItOle7i8xfLYhfcDr+Az+NRWyWC99zk2v7xhRz+u5KNlb0P7hvgx8cPC3xH0jxB4P+H+tj4p6/wCH50mu7q9mjNlbPdu4SEzIsgDxrE2UjjGAOoJNfB/7an7QX7S37NXi7wxH4NXR4ZPEX2mK/h0/TnSztrG3QTyzzXbs0zTKFCRElFJbG017D/wSU+AGk/CjS/E3xC8NW62t14li07Tpo4hiIz2kRe4fGSC3mzEMx5yCO1fd37a/7PNn8WvhtfwWwVHu9MudJlO3hPtKYhmOP+ecwTd6KxPavj4YZYnAxxkG3117Xd2uvnvsffVKjoYmVCVv+Db+lsfwHeLfE2reONcufEOpOS9xI0pTJKoGJO1ck8LnA9u9c3hV4Ga3dY8Na54b1i+8N63bvb3unXElrcROCGSaFijoR2IYEUujaFf6rqkOmWkbz3UxxHBErSSv/uooLN+Ar9KpxhGCs7RX5H5LKM5Td1dlrw7os2o3ShFzzX9Cv/BJX9lXWPFPxAi+Id7bMlrpu25R5FO0SGNktuT6LLLOR6GA968E/YE/4J+fE/4seKLPXl0pGsLSVWlmu1D2ERB+b7S/KzsP+fWEsxPErRL1/ry+Enwm8KfBvwfB4Q8KRBUTLzSkAPNK5y8jY7secdAMAcAY8OvifrdSMaWtNO7fdrZLyvq38j6vLMA8MnUq6SeiXbu3+SXzPQNL0220jT4tNsxiOFQo9T7n3PWr9FFemdAUUUUAf//U/vC8SfDnwV4tvf7S16xWW5Efk+cjvFLsB3Bd8bK3ysSV5+UkkYya/Hj/AILAaZr9j+zrqt87s1pNq9lExz1QZdUbnOMgdepHrX7e18Nf8FCPgbqvx6/Zi8U+BfDkavqdzbx3FiGIUG8tHEsKFjwvmgNFuPALAnivNx2Hj7tTs038mVUlKVOUN7ppfM/hq8TeIrC5aQQ2kME2cM0a7Rgei9Aa8vnvWcnHatfX7afStWudI1xXsr+zkaG4tbhTFPFIpwySRvhlYHggisax0+71i5+x6TE93Mf+WcCtK/8A3ymTXuxcFHmvofFRpa8ttStEWkb619E/s6/AvxD8bvirp3h/SbJr23tZYpJ1wSjuWzDCx6YkcDd6Rh27V6N+zx+xZ8YPjh4lh0jw3pF3d/Oomjso1uJUGeRK5Zba29zcSow7I54P9fv7Fn7DXhP9mrwfaJqOn2kGoqTN9nt2M4ilcAM8ty6o9xMQMFyqKB8qKFAr5/NsbOvD6vg9ebRy6RXVru+1uu59Rk+WunUVfFKyWqXVvp6LufQv7Nfwetfg18LdJ8IofMktYAHkIwZJpCZJpT7yyMzewIFe/wA8EN1A9tcqHjkUqytyCCMEH61LRXoUqMYQVOK0St8jvqVZTk5y3Z+Un7UX/BJf4EftKeO5/iLKlnpGq3aos90tk0k0jIoQPI0dxCsrYAGZFY8ck1f/AGf/APgkV+yx8ESt7rEd34suxjct95UFmSOmbS0SKOQe0/m1+plFcayjDdYX9dV9z0NVi6i2dvz+/cpabpunaNYQ6VpFvHa2tuoSKGFAkaKOAqqoAUDsAMVdoor0EraI5mwooopgFFFFAH//1f7+KinghuoHtrlBJHICrKwyCDwQRUtFAHw18Vf+Cef7O/xf1B9S8UW90sj8ZQ28jgeiy3EE0qgdgHwO2Ko/D/8A4Jofsb/D2SK5g8K/2xNCdytq91PfID6iCVzbj8IhX3nRXD/ZmHvzci+46VjKtrKTMrRNC0Tw1psWjeHLODT7OEYjgto1iiQeiogCj8BWrRRXaklojnbCiiimIKKKKACiiigAooooAKKKKAP/1v7+KKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigD/2Q=="
                            alt="Category"
                        />
                    </div>
                    <div>Akcesoria</div>
                </div>
            </div>
            <div class="sc-inRwDn bFwSdS MoreCategoriesButton">
                <div class="sc-dPyBCJ tcXIG undefined dropdown-wrap">
                    <div>
                        <button class="sc-efBctP kkFYhG">
                            <div class="sc-IAann iavpGv">
                                <div>
                                    <div class="sc-dTbhCw kNPTSl"><img src="https://app.spocket.co/static/media/icon-more.95ce9e9a.svg" alt="category" /> Więcej kategorii</div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<ul class="sc-kxCoLp buWXYA"></ul>
<!-- SORT BY -->
<div class="sc-fJoEar cLgFUE">
    <div class="sc-bQRcPC hGPTCq">
        <div class="sc-laFCIP eMFWXt intercom__quick-filter__location">
            <div class="sc-dPyBCJ tcXIG undefined dropdown-wrap">
                <div>
                    <button class="sc-efBctP kkFYhG">
                        <input type="checkbox" class="sc-cMOycp kTcDpM" />
                        <label class="sc-kSmoGW sc-EmgEd ixMerl bIgMZl">
                            <div class="sc-ibkoSk exLfvJ">
                                <div class="sc-dhyxXW iuLLJm"><img src="https://app.spocket.co/static/media/icon-colored-globe.007a5bca.svg" alt="globe" /> Wysyłka z <span></span></div>
                            </div>
                            <img src="https://app.spocket.co/static/media/icon-expand.d7698696.svg" alt="expand" class="sc-keiIcO cxmezv" />
                        </label>
                    </button>
                </div>
            </div>
        </div>
        <div class="sc-laFCIP eMFWXt intercom__quick-filter__inventory">
            <div class="sc-dPyBCJ tcXIG undefined dropdown-wrap">
                <div>
                    <button class="sc-efBctP kkFYhG">
                        <label class="sc-kSmoGW sc-EmgEd ixMerl bIgMZl">
                            <div class="sc-ibkoSk exLfvJ">
                                <div class="sc-dhyxXW iuLLJm"><img src="https://app.spocket.co/static/media/icon-fast-shipping.a2845b33.svg" alt="truck" />Wysyłka w </div>
                            </div>
                            <img src="https://app.spocket.co/static/media/icon-expand.d7698696.svg" alt="expand" class="sc-keiIcO cxmezv" />
                        </label>
                    </button>
                </div>
            </div>
        </div>
        <label class="sc-kSmoGW ixMerl intercom__quick-filter__premium filterBy" data-val="latest" onclick="searchFilter();">
            <input type="checkbox" class="sc-cMOycp kTcDpM" />
            <div class="sc-dhyxXW iuLLJm"><img src="https://app.spocket.co/static/media/crown-premium.1fe58ae9.svg" alt="Crow" /> Najnowsze</div>
        </label>
        <label class="sc-kSmoGW ixMerl sc-ewgOdx bGiojC intercom__quick-filter__shipping-time filterBy" title="Fast USA shipping" data-val="in_stock" onclick="searchFilter();">
            <input type="checkbox" class="sc-cMOycp kTcDpM" />
            <div class="sc-dhyxXW iuLLJm"><img src="https://app.spocket.co/static/media/icon-boxes.dc18b6d5.svg" alt="boxes" /> W magazynie</div>
        </label>
        <label class="sc-kSmoGW ixMerl sc-DJmSI ebFbwb intercom__quick-filter__shipping_under" title="USA shipping under $5" onclick="searchFilter('promo');">
            <input type="checkbox" class="sc-cMOycp kTcDpM" />
            <div class="sc-dhyxXW iuLLJm"><img src="https://app.spocket.co/static/media/icon-shipping-under-5.c834c71e.svg" alt="coin with arrow down" /> Aktualnie na promocji</div>
        </label>
         <label class="sc-kSmoGW ixMerl sc-DJmSI ebFbwb intercom__quick-filter__shipping_under filterBy" title="USA shipping under $5" data-val="added_to" onclick="searchFilter();">
            <input type="checkbox" class="sc-cMOycp kTcDpM" />
            <div class="sc-dhyxXW iuLLJm"><img src="https://app.spocket.co/static/media/icon-fast-shipping.a2845b33.svg" alt="coin with arrow down" /> Dodane przez</div>
        </label>
        <div class="sc-laFCIP eMFWXt intercom__quick-filter__inventory">
            <div class="sc-dPyBCJ tcXIG undefined dropdown-wrap">
                <div>
                    <button class="sc-efBctP kkFYhG">
                    <select class="sc-kSmoGW sc-EmgEd ixMerl bIgMZl sc-ibkoSk exLfvJ sc-dhyxXW iuLLJm form-control" id="filterBy" onchange="searchFilter();">  <option style="background-image:url(https://app.spocket.co/static/media/icon-fast-shipping.a2845b33.svg);" value="">Dodane przez </option>
                <option value="1">Active</option>
                <option value="0">Inactive</option></select>
                            <img src="https://app.spocket.co/static/media/icon-expand.d7698696.svg" alt="expand" class="sc-keiIcO cxmezv" />
                    </button>
                </div>
            </div>
        </div>
        <div class="sc-laFCIP eMFWXt intercom__quick-filter__inventory">
            <div class="sc-dPyBCJ tcXIG undefined dropdown-wrap">
                <div>
                    <button class="sc-efBctP kkFYhG">
                        <label class="sc-kSmoGW sc-EmgEd ixMerl bIgMZl">
                            <div class="sc-ibkoSk exLfvJ">
                                <div class="sc-dhyxXW iuLLJm"><img src="https://app.spocket.co/static/media/icon-fast-shipping.a2845b33.svg" alt="truck" />Status </div>
                            </div>
                            <img src="https://app.spocket.co/static/media/icon-expand.d7698696.svg" alt="expand" class="sc-keiIcO cxmezv" />
                        </label>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="sc-dPyBCJ tcXIG sc-bhpuBD bdOfaa dropdown-wrap">
        <div>
            <button class="sc-efBctP kkFYhG">
                <div class="sc-ctuRtO jdIgSX">
                    <div class="sc-dpRLZP iUmrBv">
                        <div class="sc-bgnbwU fDrLve">Sortuj</div>
                        <div class="sc-ccJWcV flFbbx">Najnowsze</div>
                    </div>
                    <img src="https://app.spocket.co/static/media/icon-expand.d7698696.svg" alt="expand" class="sc-kSzVC dQjLhG" />
                </div>
            </button>
        </div>
    </div>
</div>
<div class="sc-iJkHyd jUaIoj" style="margin-bottom: 32px;"></div>
<div width="1169px" class="sc-gmSHEY hCkdaG">
    <div>
        <div class="sc-VcoSR kOQIkz" id="dataContainer">
                <div class="loading-overlay"><div class="overlay-content">Ładowanie...</div></div>

                <?php
                // Include pagination library file
                include_once "Pagination.class.php";

                // Set some useful configuration
                $baseURL = "getData.php";
                $limit = 25;

                // Count of all records
                $query = $conn->query(
                    "SELECT COUNT(*) as rowNum FROM products_platform"
                );
                $result = $query->fetch_assoc();
                $rowCount = $result["rowNum"];

                // Initialize pagination class
                $pagConfig = [
                    "baseURL" => $baseURL,
                    "totalRows" => $rowCount,
                    "perPage" => $limit,
                    "contentDiv" => "dataContainer",
                    "link_func" => "searchFilter",
                ];
                $pagination = new Pagination($pagConfig);

                // Fetch records based on the limit
                $query = $conn->query(
                    "SELECT * FROM products_platform ORDER BY id DESC LIMIT $limit"
                );

                if ($query->num_rows > 0) {
                    $i = 0;
                    while ($row = $query->fetch_assoc()) {
                        $i++; ?>
               
            

            <div data-testid="listing-card-d0cacca0-4b8d-489d-803b-29658a851bad" class="sc-hrzOVh lgtHfE " id="product_id_<?php echo $row[
                "id"
            ]; ?>" style="cursor: pointer;">

                    <?php if (
                        strpos($row["added_allegro"], "allegro") !== false ||
                        strpos($row["added_olx"], "olx") !== false ||
                        strpos($row["added_erli"], "erli") !== false ||
                        strpos($row["added_alione"], "alione") !== false ||
                        strpos($row["added_sprzedajemy"], "sprzedajemy") !==
                            false ||
                        strpos($row["added_fb_marketplace"], "facebook") !==
                            false ||
                        strpos($row["added_pinterest"], "pinterest") !== false
                    ) { ?>  
                          <div data-cy="listing-card-container" class="sc-hcJkSI hmWAub vwo_product-card-sample-order added">
                            <?php } elseif ($row["need_update"] == "1") { ?>   
                             <div data-cy="listing-card-container" class="sc-hcJkSI hmWAub vwo_product-card-sample-order need_to_update">

                              <?php } else { ?>
                           <div data-cy="listing-card-container" class="sc-hcJkSI hmWAub vwo_product-card-sample-order waiting_to_add">
                            <?php } ?>

                        <div class="sc-bdxVC bpLxlG"> <div class="id_product_class">#<?php echo $row[
                            "id"
                        ]; ?></div><div data-cy="listingCardImage" class="sc-keNpes eHxGQo productt" id="<?php echo $row[
    "id"
]; ?>"  style="padding: 10px;"><img width="100%" height="100%" style="    border-radius: 20px;" src="<?php echo $row[
    "img"
]; ?>"/></div></div>
                 
                    <div class="sc-bAKPPm gbaRNO sc-iOnGvX jNbeVB"></div>
                    <div class="sc-jFdHWG iJtlpr">
                        <a  href='<?php echo $row[
                            "source_url"
                        ]; ?>' title="Przenieś do źródła" target="_blank" class="sc-cBOWjd dXzXnO">
                            <h3 title="<?php echo $row[
                                "title"
                            ]; ?>" class="sc-cmYsgE fPyFCH"><?php echo $row[
    "title"
]; ?></h3>
                        </a>
                              <?php if (
                                  strpos($row["added_allegro"], "allegro") !==
                                      false ||
                                  strpos($row["added_olx"], "olx") !== false ||
                                  strpos($row["added_erli"], "erli") !==
                                      false ||
                                  strpos($row["added_alione"], "alione") !==
                                      false ||
                                  strpos(
                                      $row["added_sprzedajemy"],
                                      "sprzedajemy"
                                  ) !== false ||
                                  strpos(
                                      $row["added_fb_marketplace"],
                                      "facebook"
                                  ) !== false ||
                                  strpos(
                                      $row["added_pinterest"],
                                      "pinterest"
                                  ) !== false
                              ) { ?>
                                 <p class="sc-ePsPkC cSWRJD">Dodane na:</p>
                                <?php } else { ?>
                                <p class="sc-ePsPkC cSWRJD" style="color: orange;">Oczekuje na dodanie</p>
                                <?php } ?>

                        <div class="sc-fejtnb dboBku">

                            <?php if (
                                strpos($row["added_allegro"], "allegro") !==
                                    false ||
                                strpos($row["added_olx"], "olx") !== false ||
                                strpos($row["added_erli"], "erli") !== false ||
                                strpos($row["added_alione"], "alione") !==
                                    false ||
                                strpos(
                                    $row["added_sprzedajemy"],
                                    "sprzedajemy"
                                ) !== false ||
                                strpos(
                                    $row["added_fb_marketplace"],
                                    "facebook"
                                ) !== false ||
                                strpos($row["added_pinterest"], "pinterest") !==
                                    false
                            ) {
                                if (
                                    strpos($row["added_allegro"], "allegro") !==
                                    false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_allegro"
                                        ]; ?>"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Allegro.pl_sklep.svg/1200px-Allegro.pl_sklep.svg.png" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_olx"], "olx") !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://www.wykop.pl/cdn/c3201142/comment_16444239007niM9IA4dAgAeGOeYIPxNp.jpg" class="rectangle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_erli"], "erli") !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://erli.pl/metodydostaw/assets/images/og-image.png" class="rectangle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_alione"], "alione") !==
                                    false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://alione.pl/wp-content/uploads/2022/02/alione.png" class="rectangle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_sprzedajemy"],
                                        "sprzedajemy"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWM8aVOl-wAggKC6xjUqBSO2I7Cc29SR3le1b42iZKY-gbaEOFnydweLbacVecVnQ2mBM&usqp=CAU" class="circle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_fb_marketplace"],
                                        "facebook"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://www.pinpng.com/pngs/m/557-5572338_facebook-marketplace-logo-marketplace-facebook-hd-png-download.png" class="circle" /></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_pinterest"],
                                        "pinterest"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://logoeps.com/wp-content/uploads/2012/02/pinterest-icon-vector.png" class="circle" /></div>
                                    </div>
                                    <?php }
                            } else {
                                 ?>
                                   <div class="sc-kGhOqx fkLHKw">
                                        <div style="height: 35px; background: transparent;"></div>
                                    </div>
                                  <?php
                            } ?>

                        </div>

                    </div>
                             <button class="sc-efBctP kkFYhG" style="    padding-left: 18px; display: inline-flex;">
                                <div class="sc-eTFcpK ilxWoB"  style="    padding: 0px; margin-left: 0px;margin-top: -5px;">
                                    <p class="sc-kRktcz dKCUmk">Dostawa</p>
                                    <div class="sc-ejVUYw bMpfhh">
                                        <p class="sc-khBlLl flPgJW"><?php echo $row[
                                            "source_shippment_price"
                                        ]; ?> zł</p>
                                        <img src="https://sklepwind.pl/userdata/public/gfx/b736be663d442eeb587f5d13c5ba8ac6.jpg" alt="PL flag" class="country-flag" />
                                        <p class="sc-bfKFlL mlPNl"><?php echo $row[
                                            "source_shippment_time"
                                        ]; ?> dni</p>
                                        <img src="https://app.spocket.co/static/media/icon-expand-dark.c67cbf55.svg" alt="expand" class="sc-eEpejC dqHGKV" style="z-index: 9999;"/>
                                    </div>
                                </div>
                                <div class="sc-eTFcpK ilxWoB"  style="    padding: 0px; margin-left: 0px;margin-top: -5px; padding-right: 15px;">
                                    <p class="sc-kRktcz dKCUmk" style="  text-align: right;">W magazynie</p>
                                    <div class="sc-ejVUYw bMpfhh" style="float: right;">
                                        <p class="sc-khBlLl flPgJW" style="float: right;">
                                          <script> 
                                            var product_id = <?php echo $row[
                                                "id"
                                            ]; ?>;
                                            var product_id_class = '#product_id_'+product_id+' .hmWAub';
                                          </script>
                                          <?php if ($row["source"] == "aptel") {
                                              if (
                                                  $row["source_quantity"] == "0"
                                              ) {
                                                  echo "0 sztuk";
                                                  echo "<script>$(product_id_class).addClass('warning');</script>";
                                              } elseif (
                                                  $row["source_quantity"] == "1"
                                              ) {
                                                  echo "Mała ilość";
                                              } elseif (
                                                  $row["source_quantity"] == "2"
                                              ) {
                                                  echo "Średnia ilość";
                                              } elseif (
                                                  $row["source_quantity"] == "3"
                                              ) {
                                                  echo "Duża ilość";
                                              }
                                          } else {
                                              if (
                                                  $row["source_quantity"] == "0"
                                              ) {
                                                  echo "<script>$(product_id_class).addClass('warning');</script>";
                                              }
                                              echo $row["source_quantity"] .
                                                  " sztuk";
                                          } ?></p>
                                    </div>
                                </div>


                            </button>
                    <div class="sc-dPyBCJ tcXIG undefined dropdown-wrap" style="position: absolute; bottom: 0;">

                        <div style="    padding-left: 20px; padding-right: 20px;margin-bottom: -10px;">
                             <div class="sc-eQNgno hooQiq">
                                <p>Cena źródłowa</p>
                                <p>Nasza cena  </p>
                                <p style="color: transparent;">X</p>
                                <p>Zysk brutto </p>
                            </div>
                            <div class="sc-kOsxa-d iWOQkG">
                                <p class="sc-hGtivm inUgxW"><?php echo $row[
                                    "source_price"
                                ]; ?><span>zł</span></p>
                                <p class="sc-coCPJf cXsSnB"><?php echo $row[
                                    "price"
                                ]; ?><span>zł</span></p>
                                <p class="sc-coCPJf cXsSnB" style="color: #00cd00;">+ <?php echo $row[
                                    "price"
                                ] - $row["source_price"]; ?><span>zł</span></p>

                            </div>
                        </div>
                    </div>
                    <div class="sc-bcnBk bDJZpd card-button-section">
                        <div class="sc-fYHEnZ kgpauv">
                            <div class="sc-geuGuN dQUKSz">
                                <button title="Add product to import list" data-cy="add-product-to-import-list" class="sc-hKMtZM cGrIMx listing-card__add-to-import-list"><span class="add-span">+</span>Add to Import List</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sc-hcJkSI sc-jTUlZf hmWAub ehBoci vwo_product-card-sample-order-variant" data-cy="listing-card-container" style="display: none;">
                    <a title="<?php echo $row[
                        "title"
                    ]; ?>" target="_blank" rel="noopener noeferrer" data-cy="listing-card-image" href="<?php echo $row[
    "source_url"
]; ?>">
                        <div class="sc-bdxVC bpLxlG">
                         <div data-cy="listingCardImage" class="sc-keNpes eHxGQo"></div></div>
                    </a>
                    <div class="sc-bAKPPm gbaRNO sc-iOnGvX jNbeVB"></div>
                    <div class="sc-jFdHWG iJtlpr">
                        <a  href='<?php echo $row[
                            "source_url"
                        ]; ?>' title="Przenieś do źródła" target="_blank" class="sc-cBOWjd dXzXnO">
                            <h3 title="<?php echo $row[
                                "title"
                            ]; ?>" class="sc-cmYsgE fPyFCH"><?php echo $row[
    "title"
]; ?></h3>
                        </a>

                        <div class="sc-fejtnb dboBku">
                            <?php if (
                                strpos($row["added_allegro"], "allegro") !==
                                    false ||
                                strpos($row["added_olx"], "olx") !== false ||
                                strpos($row["added_erli"], "erli") !== false ||
                                strpos($row["added_alione"], "alione") !==
                                    false ||
                                strpos(
                                    $row["added_sprzedajemy"],
                                    "sprzedajemy"
                                ) !== false ||
                                strpos(
                                    $row["added_fb_marketplace"],
                                    "facebook"
                                ) !== false ||
                                strpos($row["added_pinterest"], "pinterest") !==
                                    false
                            ) {
                                if (
                                    strpos($row["added_allegro"], "allegro") !==
                                    false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_allegro"
                                        ]; ?>"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Allegro.pl_sklep.svg/1200px-Allegro.pl_sklep.svg.png" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_olx"], "olx") !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_olx"
                                        ]; ?>"><img src="https://www.wykop.pl/cdn/c3201142/comment_16444239007niM9IA4dAgAeGOeYIPxNp.jpg" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_erli"], "erli") !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_erli"
                                        ]; ?>"><img src="https://erli.pl/metodydostaw/assets/images/og-image.png" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos($row["added_alione"], "alione") !==
                                    false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_alione"
                                        ]; ?>"><img src="https://alione.pl/wp-content/uploads/2022/02/alione.png" class="rectangle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_sprzedajemy"],
                                        "sprzedajemy"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWM8aVOl-wAggKC6xjUqBSO2I7Cc29SR3le1b42iZKY-gbaEOFnydweLbacVecVnQ2mBM&usqp=CAU" class="circle" /></div>
                                    </div>
                                    <?php }

                                if (
                                    strpos(
                                        $row["added_fb_marketplace"],
                                        "facebook"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_fb_marketplace"
                                        ]; ?>"><img src="https://www.pinpng.com/pngs/m/557-5572338_facebook-marketplace-logo-marketplace-facebook-hd-png-download.png" class="circle" /></a></div>
                                    </div>
                                    <?php }
                                if (
                                    strpos(
                                        $row["added_pinterest"],
                                        "pinterest"
                                    ) !== false
                                ) { ?>
                                    <div class="sc-kGhOqx fkLHKw">
                                        <div><a href="<?php echo $row[
                                            "added_pinterest"
                                        ]; ?>"><img src="https://logoeps.com/wp-content/uploads/2012/02/pinterest-icon-vector.png" class="circle" /></a></div>
                                    </div>
                                    <?php }
                            } else {
                                 ?>
                                   <div class="sc-kGhOqx fkLHKw">
                                        <div style="height: 35px; background: transparent;"></div>
                                    </div>
                                  <?php
                            } ?>
                        </div>
                    </div>
                             <button class="sc-efBctP kkFYhG" style="    padding-left: 15px;">
                                <div class="sc-eTFcpK ilxWoB"  style="    padding: 0px; margin-left: 0px;margin-top: -5px;">
                                    <p class="sc-kRktcz dKCUmk">Dostawa</p>
                                    <div class="sc-ejVUYw bMpfhh">
                                        <p class="sc-khBlLl flPgJW"><?php echo $row[
                                            "source_shippment_price"
                                        ]; ?> zł</p>
                                        <img src="https://app.spocket.co/static/media/US.60ed06f2.svg" alt="US flag" class="country-flag" />
                                        <p class="sc-bfKFlL mlPNl"><?php echo $row[
                                            "source_shippment_time"
                                        ]; ?> dni</p>
                                        <img src="https://app.spocket.co/static/media/icon-expand-dark.c67cbf55.svg" alt="expand" class="sc-eEpejC dqHGKV" />
                                    </div>
                                </div>
                            </button>
                    <div class="sc-dPyBCJ tcXIG undefined dropdown-wrap" style="position: absolute; bottom: 0;">

                        <div style="    padding-left: 20px; padding-right: 20px;margin-bottom: -10px;">
                             <div class="sc-eQNgno hooQiq">
                                <p>Cena źródłowa</p>
                                <p>Nasza cena  </p>
                                <p style="color: transparent;">X</p>
                                <p>Zysk brutto </p>
                            </div>
                            <div class="sc-kOsxa-d iWOQkG">
                                <p class="sc-hGtivm inUgxW"><?php echo $row[
                                    "source_price"
                                ]; ?><span>zł</span></p>
                                <p class="sc-coCPJf cXsSnB"><?php echo $row[
                                    "price"
                                ]; ?><span>zł</span></p>
                                <p class="sc-coCPJf cXsSnB" style="color: #00cd00;">+ <?php echo $row[
                                    "price"
                                ] - $row["source_price"]; ?><span>zł</span></p>

                            </div>
                        </div>
                    </div>
                    <div class="sc-cQIpJi ihJgFL vwo_product-card-sample-order-variant">
                        <div class="sc-geuGuN dQUKSz">
                            <button title="Add product to import list" data-cy="add-product-to-import-list" class="sc-hKMtZM cGrIMx listing-card__add-to-import-list"><span class="add-span">+</span>Add to Import List</button>
                        </div>
                        <button class="sc-hKMtZM lbHCNF">Order Samples</button>
                    </div>
                  </div>
                </div>
<?php
                    }
                } else {
                    echo '<tr><td colspan="6">Niczego nie znaleziono...</td></tr>';
                }
                ?>
                    
        <?php echo $pagination->createLinks(); ?>

  
            </div>   



            <div class="sc-fCdBJp hWoppi"></div>
            <div class="sc-fCdBJp hWoppi"></div>

        </div>
        <div class="sc-dFdIVH ikmYAR">
            <div data-testid="loading-icon-listing-cards" class="sc-brCFrO dwOwY">
                <div class="sc-gITdmR jUbdfL">
                    <div class="sc-evrZIY sc-fIavCj bBLuqI"></div>
                    <div class="sc-evrZIY sc-duzrYq bBLuqI gprhlU"></div>
                    <div class="sc-evrZIY sc-dkdnUF bBLuqI bwIehr"></div>
                </div>
            </div>
        </div>
    </div>
</div>

   </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var filterBy = $('.filterBy').attr("data-val");
    console.log(filterBy);
    $.ajax({
        type: 'POST',
        url: 'getData.php',
        data:'page='+page_num+'&keywords='+keywords+'&filterBy='+filterBy,
        beforeSend: function () {
            $('.loading-overlay').show();
            $('#dataContainer').addClass("blur");
        },
        success: function (html) {
            $('#dataContainer').html(html);
            $('#dataContainer').removeClass("blur");
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
<div class="addProductModal">
    <div class="ReactModal__Overlay ReactModal__Overlay--after-open addProductModal__Overlay addProductModal__Overlay__light">
        <div class="ReactModal__Content ReactModal__Content--after-open addProductModal__Content" tabindex="-1" role="dialog" aria-modal="true">
            <div class="sc-grVGCS hauPWX">
                <div class="sc-jmnVvD kLGAUF">
                    <span>Dodaj produkt</span>
                    <div class="sc-iXxrte dvQMyw" id="close_product_modal"><img src="https://app.spocket.co/static/media/close-icon.fec6d612.svg" alt="close" /></div>
                </div>
            </div>
            <div class="sc-afnQL dLhHCP">
                <div class="sc-kngDgl dTYzCa">
                    <div class=" css-8nvh74-control">
                        <div class=" css-1hwfws3">
                            <input type="text" class="css-16vhkgm-placeholder" id="input_add_product_modal" placeholder="Wprowadź link..."/>
                            <div class="css-1g6gooi">
                                <div class="" style="display: inline-block;"><input autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-2-input" spellcheck="false" tabindex="0" type="text" aria-autocomplete="list" value="" style="box-sizing: content-box; width: 2px; background: 0px center; border: 0px; font-size: inherit; opacity: 1; outline: 0px; padding: 0px; color: inherit;">
                                    <div style="position: absolute; top: 0px; left: 0px; visibility: hidden; height: 0px; overflow: scroll; white-space: pre; font-size: 14px; font-family: Avenir, Nunito, sans-serif; font-weight: 500; font-style: normal; letter-spacing: normal; text-transform: none;"></div>
                                </div>
                           </div>
                        </div>
                    </div>
                    <div class="variables">
                        
                    </div>
                    <div class="after_url">
                        <div>
                        <img id="product_img_modal" src="" height="250px" width="250px" style="max-width: 250px; max-height: 250px;" />
                        <div class="text_area_additional_info" style="    margin-top: 50px; margin-left: 10px; margin-start: 10px;">
                            <div class="sc-cwpsFg fdrCFp">Uwagi</div>
                            <div style="    border-radius: 4px; border: 1px solid rgb(230, 232, 240);text-align: left;padding: 16px;    height: 134px;">
                            <textarea style="width: 100%;height: 100%;" id="comments" placeholder="Wprowadź uwagi..."></textarea>
                            </div>
                        </div>
                        </div>
                        <div style="margin-left: 20px;">
                            <div id="product_title_modal" style="font-size: 24px;font-weight: bold;"> </div>
                           <div style="font-size: 14px; font-weight:bold; color: orange;     margin-right: 10px;">Sugerowany tytuł: </div> 
                              <div class="title_new_class" style="display:inline-flex;">
                               <input class="product_title_new_modal" placeholder="Utwórz tytuł" type="text" size="16" maxlength="50"  style="text-transform:uppercase; width: 530px;font-size: 16px;"  id="input_title_new" required>
                          </div>
                            <div id="product_shippment_modal" style="margin-top: 10px;">
                                <div class="sc-cwpsFg fdrCFp variablesTitle">Warianty</div>
                                <div class="variablesModal"></div>
                                <div class="sc-cwpsFg fdrCFp">Wysyłka z</div>
                                        <div class="sc-tQuYZ jhhXFP" style="display: flex;">
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="china_ship"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Flag_of_the_People%27s_Republic_of_China.svg/255px-Flag_of_the_People%27s_Republic_of_China.svg.png"  width="25px" alt="flag" class="country-flag" /> Chiny</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="poland_ship"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/en/1/12/Flag_of_Poland.svg" width="25px" alt="flag" class="country-flag" /> Polska</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="germany_ship"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/en/b/ba/Flag_of_Germany.svg"  width="25px" alt="flag" class="country-flag" /> Niemcy</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="france_ship"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c3/Flag_of_France.svg/1200px-Flag_of_France.svg.png"  width="25px" alt="flag" class="country-flag" /> Francja</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="czech_ship"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Flag_of_the_Czech_Republic.svg/255px-Flag_of_the_Czech_Republic.svg.png"  width="25px" alt="flag" class="country-flag" /> Czechy</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                <div class="sc-gJwTLC bMazvL" style="display: flex; margin-top: 10px;">
                                      <div class="sc-iWajrY bmHJSZ">
                                        <div class="sc-dkSuNL kfmEjW">Koszt dostawy</div>
                                        <div role="radiogroup" name="shippingUnderFilter"  style="display: flex;     display: grid; grid-template-columns: repeat(2, 160px);">
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label class="sc-gXmSlM AEgKY rJDAdk">
                                                    <input type="radio" disabled name="shippingUnderFilter" aria-checked="true" class="sc-himrzO gLYyPe" value="0" checked=""/><span class="sc-jIZahH jLcNAu shipping_price_choose" id="free_shippment_span"></span>Darmowa dostawa
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label class="sc-gXmSlM AEgKY rJDAdk">
                                                    <input type="radio" disabled name="shippingUnderFilter" aria-checked="false" class="sc-himrzO gLYyPe" value="5" checked="" /><span class="sc-jIZahH jLcNAu shipping_price_choose" id="5less_shippment_span"></span>5 zł lub mniej
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label  class="sc-gXmSlM AEgKY rJDAdk">
                                                    <input type="radio" disabled name="shippingUnderFilter" aria-checked="false" class="sc-himrzO gLYyPe" value="15" /><span class="sc-jIZahH jLcNAu shipping_price_choose" id="15less_shippment_span"></span>15 zł lub mniej
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label  class="sc-gXmSlM AEgKY rJDAdk">
                                                    <input type="radio" disabled name="shippingUnderFilter" aria-checked="false" class="sc-himrzO gLYyPe" value="25" /><span class="sc-jIZahH jLcNAu shipping_price_choose" id="25less_shippment_span"></span>25 zł lub mniej
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc-iWajrY bmHJSZ" style="width: 50%;">
                                        <div class="sc-dkSuNL kfmEjW">Czas dostawy</div>
                                        <div role="radiogroup" name="shippingTimeFilter" style="display: flex;     display: grid; grid-template-columns: repeat(2, 130px);">
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter"  aria-checked="true" class="sc-himrzO gLYyPe" value="1-3" checked="" /><span class="sc-jIZahH jLcNAu shipping_time_choose" id="1_3_day_shippment_span"></span>1-3 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label  class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter"  aria-checked="false" class="sc-himrzO gLYyPe" value="4-7" /><span class="sc-jIZahH jLcNAu shipping_time_choose" id="4_7_day_shippment_span"></span>4-7 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter"  aria-checked="false" class="sc-himrzO gLYyPe" value="8-11" /><span class="sc-jIZahH jLcNAu shipping_time_choose"  id="8_11_day_shippment_span"></span>8-11 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter"  aria-checked="false" class="sc-himrzO gLYyPe" value="12-15" /><span class="sc-jIZahH jLcNAu shipping_time_choose"  id="12_15_day_shippment_span"></span>12-15 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label  class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter"  aria-checked="false" class="sc-himrzO gLYyPe" value="16-25" /><span class="sc-jIZahH jLcNAu shipping_time_choose"  id="16_25_day_shippment_span"></span>16-25 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label  class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter"  aria-checked="false" class="sc-himrzO gLYyPe" value="25+" /><span class="sc-jIZahH jLcNAu shipping_time_choose"  id="25_day_shippment_span"></span>25+ Dni
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div id="product_price_modal_n" style="margin-top: 20px;">
                                <div class="sc-cwpsFg fdrCFp">Sugerowana cena produktu</div>
                                <div class="sc-gJwTLC bMazvL">
                                    <div class="sc-cHPgQl bZVMxs" style="width: 100%;">
                                                  
                                                  <div class="range-box">        
                                                    <div title="Decrease" class="control-minus">-</div>    
                                                    <input id="month-price" type="range" step="0.01" value="87">    
                                                    <div class="range-value" id="current-value"><span  id="product_price_modal" style="-webkit-user-select: none; /* Safari */ -moz-user-select: none; /* Firefox */ -ms-user-select: none; /* IE10+/Edge */user-select: none; /* Standard */"></span></div>
                                                    <span class="legend-min" id="product_price_min_modal" style="-webkit-user-select: none; /* Safari */ -moz-user-select: none; /* Firefox */ -ms-user-select: none; /* IE10+/Edge */user-select: none; /* Standard */"></span>
                                                    <span class="legend-max" id="product_price_max_modal" style="-webkit-user-select: none; /* Safari */ -moz-user-select: none; /* Firefox */ -ms-user-select: none; /* IE10+/Edge */user-select: none; /* Standard */"></span>
                                                    <div title="increase" class="control-plus">+</div>
                                                  </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="add_url" style="text-align: center;  height: 500px; justify-content: center; display: flex;" >
                        <img src="add_url.jpg" style=" padding: 90px;"/>
                    </div>
            </div>
            <div class="sc-grVGCS sc-KfMfS hauPWX gdYlRc"><button class="sc-hKMtZM rWXjW" id="cancel_product_modal">Anuluj</button><button id="add_product_button" class="sc-hKMtZM cGrIMx">Dodaj</button></div>
        </div>
    </div>
</div>

<div class="ProductInfoModal">
    <div class="ReactModal__Overlay ReactModal__Overlay--after-open addProductModal__Overlay addProductModal__Overlay__light">
        <div class="ReactModal__Content ReactModal__Content--after-open addProductModal__Content" tabindex="-1" role="dialog" aria-modal="true">
            <div class="sc-grVGCS hauPWX">
                <div class="sc-jmnVvD kLGAUF">
                    <span style="display: flex;">Informacje o produkcie <div id="product_info_title_id_modal" style="font-size: 16px;    color: grey;margin-top: 2px; margin-left: 10px;"></div></span> 
                    <div class="sc-iXxrte dvQMyw" id="close_product_data_modal"><img src="https://app.spocket.co/static/media/close-icon.fec6d612.svg" alt="close" /></div>
                </div>
            </div>
            <div class="sc-afnQL dLhHCP">
                <div class="sc-kngDgl dTYzCa">
                    <div class="after_url_info">
                        <div>
                        <img id="product_info_img_modal" src="" height="250px" />
                        <div class="text_area_additional_info" style="    margin-top: 50px; margin-left: 10px; margin-start: 10px;">
                            <div class="sc-cwpsFg fdrCFp">Uwagi</div>
                            <div style="    border-radius: 4px; border: 1px solid rgb(230, 232, 240);text-align: left;padding: 16px;    height: 134px;">
                            <textarea style="width: 100%;height: 100%;" id="comments_info" placeholder="Wprowadź uwagi..."></textarea>
                            </div>
                        </div>
                        </div>
                        <div style="margin-left: 20px;">
                     <div id="product_info_title_modal" style="font-size: 24px;font-weight: bold;"> </div>

                         <div style="font-size: 14px; font-weight:bold; color: orange;     margin-right: 10px;">Sugerowany tytuł: </div> 
                              <div class="title_info_new_class" style="display:inline-flex;">
                               <input class="product_info_title_new_modal" placeholder="Utwórz tytuł" type="text" size="16" maxlength="50"  style="text-transform:uppercase;   width: 530px; font-size: 16px;"  id="input_info_title_new" required>
                            <img src="https://cdn-icons-png.flaticon.com/512/1622/1622069.png" width="17px" height="17px" id="copy_suggested_title" title="Skopiuj tytuł" style="    margin-top: 3px; cursor: pointer;">
                          </div>

                            <div id="product_info_shippment_modal" style="margin-top: 10px;">
                                <div class="sc-cwpsFg fdrCFp variablesTitle_info">Warianty</div>
                                <div class="variablesModal_info"></div>
                                <div class="sc-cwpsFg fdrCFp">Wysyłka z</div>
                                        <div class="sc-tQuYZ jhhXFP" style="display: flex;">
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="china_ship_info" value-ship="ch"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Flag_of_the_People%27s_Republic_of_China.svg/255px-Flag_of_the_People%27s_Republic_of_China.svg.png"  width="25px" alt="flag" class="country-flag" /> Chiny</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="poland_ship_info" value-ship="pl"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/en/1/12/Flag_of_Poland.svg" width="25px" alt="flag" class="country-flag" /> Polska</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="germany_ship_info" value-ship="de"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/en/b/ba/Flag_of_Germany.svg"  width="25px" alt="flag" class="country-flag" /> Niemcy</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="france_ship_info" value-ship="fr"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c3/Flag_of_France.svg/1200px-Flag_of_France.svg.png"  width="25px" alt="flag" class="country-flag" /> Francja</span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="sc-ivTmOn hTOJBx">
                                                <label class="sc-llJcti fRtOUX">
                                                    <input type="checkbox" class="sc-gicCDI ikJpAo" />
                                                    <span class="sc-kLLXSd gXBmeo">
                                                        <span class="sc-iIPllB hdxmeq" id="czech_ship_info" value-ship="cz"><img style="border-radius: 30%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Flag_of_the_Czech_Republic.svg/255px-Flag_of_the_Czech_Republic.svg.png"  width="25px" alt="flag" class="country-flag" /> Czechy</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                <div class="sc-gJwTLC bMazvL" style="display: flex; margin-top: 10px;">
                                      <div class="sc-iWajrY bmHJSZ">
                                        <div class="sc-dkSuNL kfmEjW">Koszt dostawy</div>
                                        <div role="radiogroup" name="shippingUnderFilter_info"  style="display: flex;     display: grid; grid-template-columns: repeat(2, 160px);">
                                            <div class="sc-ikZpkk eqUDzr rJDAdk">
                                                <label  class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingUnderFilter_info" aria-checked="true" class="sc-himrzO gLYyPe" value="0" checked=""/><span class="sc-jIZahH jLcNAu shipping_price_choose" id="free_shippment_span_info"></span>Darmowa dostawa
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr rJDAdk">
                                                <label class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingUnderFilter_info"  aria-checked="true" class="sc-himrzO gLYyPe" value="5" checked="" /><span class="sc-jIZahH jLcNAu shipping_price_choose" id="5less_shippment_span_info"></span>5 zł lub mniej
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr rJDAdk">
                                                <label class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingUnderFilter_info"  aria-checked="false" class="sc-himrzO gLYyPe" value="15" /><span class="sc-jIZahH jLcNAu shipping_price_choose" id="15less_shippment_span_info"></span>15 zł lub mniej
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr rJDAdk">
                                                <label  class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingUnderFilter_info"  aria-checked="false" class="sc-himrzO gLYyPe" value="25" /><span class="sc-jIZahH jLcNAu shipping_price_choose" id="25less_shippment_span_info"></span>25 zł lub mniej
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sc-iWajrY bmHJSZ" style="width: 50%;">
                                        <div class="sc-dkSuNL kfmEjW">Czas dostawy</div>
                                        <div role="radiogroup" name="shippingTimeFilter" style="display: flex;     display: grid; grid-template-columns: repeat(2, 130px);">
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter_info" aria-checked="true" class="sc-himrzO gLYyPe" value="1-3" /><span class="sc-jIZahH jLcNAu shipping_time_choose" id="1_3_day_shippment_span_info"></span>1-3 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter_info"  aria-checked="false" class="sc-himrzO gLYyPe" value="4-7" /><span class="sc-jIZahH jLcNAu shipping_time_choose" id="4_7_day_shippment_span_info"></span>4-7 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter_info" aria-checked="false" class="sc-himrzO gLYyPe" value="8-11" /><span class="sc-jIZahH jLcNAu shipping_time_choose"  id="8_11_day_shippment_span_info"></span>8-11 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label  class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter_info"  aria-checked="false" class="sc-himrzO gLYyPe" value="12-15" /><span class="sc-jIZahH jLcNAu shipping_time_choose"  id="12_15_day_shippment_span_info"></span>12-15 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter_info"  aria-checked="false" class="sc-himrzO gLYyPe" value="16-25" /><span class="sc-jIZahH jLcNAu shipping_time_choose"  id="16_25_day_shippment_span_info"></span>16-25 Dni
                                                </label>
                                            </div>
                                            <div class="sc-ikZpkk eqUDzr">
                                                <label  class="sc-gXmSlM AEgKY">
                                                    <input type="radio" name="shippingTimeFilter_info" aria-checked="false" class="sc-himrzO gLYyPe" value="25+" /><span class="sc-jIZahH jLcNAu shipping_time_choose"  id="25_day_shippment_span_info"></span>25+ Dni
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div id="product_price_modal_n" style="margin-top: 20px;">
                               <div style="display: inline-flex;"> <div class="sc-cwpsFg fdrCFp">Sugerowana cena produktu</div> <span id="suggested_price" style=" color: orange; font-weight: bold;   margin-top: -3px; margin-left: 12px;"></span><span id="suggested_price_zl" style="  color: orange; font-weight: bold;  margin-top: -3px; margin-left: 5px;"> zł</span></div>
                                <div class="sc-gJwTLC bMazvL">
                                    <div class="sc-cHPgQl bZVMxs" style="width: 100%;">
                                                  
                                                  <div class="range-box">        
                                                    <div title="Decrease" class="control-minus-info">-</div>    
                                                    <input id="month-price-info" type="range" step="0.01" value="87">    
                                                    <div class="range-value-info" id="current-value_info"><span  id="product_info_price_modal" style="-webkit-user-select: none; /* Safari */ -moz-user-select: none; /* Firefox */ -ms-user-select: none; /* IE10+/Edge */user-select: none; /* Standard */"></span></div>
                                                    <span class="legend-min" id="product_info_price_min_modal" style="-webkit-user-select: none; /* Safari */ -moz-user-select: none; /* Firefox */ -ms-user-select: none; /* IE10+/Edge */user-select: none; /* Standard */"></span>
                                                    <span class="legend-max" id="product_info_price_max_modal" style="-webkit-user-select: none; /* Safari */ -moz-user-select: none; /* Firefox */ -ms-user-select: none; /* IE10+/Edge */user-select: none; /* Standard */"></span>
                                                    <div title="increase" class="control-plus-info">+</div>
                                                  </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="after_url_info2" style="    margin-top: 30px;     padding-left: 10px; padding-right: 10px;">
                             <div class="sc-cwpsFg fdrCFp" style="font-size: 24px;">Dodawanie</div>
                                <div class="allegro_adding" style="display: inline-flex; position: relative; width: 100%;">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Allegro.pl_sklep.svg/1280px-Allegro.pl_sklep.svg.png" id="allegro_adding_img" width="130px" />
                                    <div id="allegro_adding_status" style="     min-width: 200px;   line-height: 43px;    height: 43px; margin-left: 30px;">
                                        <div class="checkboxxx_allegro">
                                        <input class="c-checkbox"   type="checkbox" id="checkbox">
                                        <div class="c-formContainer">
                                          <form class="c-form" action="">
                                            <input class="c-form__input_allegro" placeholder="Link do oferty" type="text" id="allegro_input_url" required>
                                            <label class="c-form__toggle_allegro" for="checkbox" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>


                                        <div class="checkboxx_allegro_new">
                                        <input class="c-checkbox_new" type="checkbox" id="checkbox_new">
                                        <div class="c-formContainer_new">
                                          <form class="c-form_new" action="">
                                            <input class="c-form__input_allegro_new" placeholder="Link do oferty" type="text" id="allegro_input_url_new" required>
                                            <label class="c-form__toggle_allegro_new" for="checkbox_new" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="allegro_adding_need_update"  style="    line-height: 43px;    height: 43px; margin-left: 120px;">Popraw</div>
                                    <div class="added_date_by" style="position: absolute;  right: 0; float: right; display: flex;  ">
                                    <div id="allegro_adding_date" style="padding-right: 30; position:  relative; height: 43px; line-height: 43px;"></div>
                                    <div id="allegro_adding_by" style="height: 43px; position: relative; line-height: 43px;">
                                        <img class="adding_by_id_avatar" src="" id="allegro_adding_by_avatar" />
                                        <div id="allegro_adding_by_name"></div>
                                    </div>
                                    </div>

                                </div>

                                <div class="olx_adding" style="display: inline-flex; position: relative; width: 100%; margin-top: 30px;">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Logotyp_OLX_.png" id="olx_adding_img" height="40px" />
                                    <div id="olx_adding_status" style="     min-width: 200px;   line-height: 43px;    height: 43px; margin-left: 30px;">
                                        <div class="checkboxxx_olx">
                                        <input class="c-checkbox"   type="checkbox" id="checkbox_olx">
                                        <div class="c-formContainer">
                                          <form class="c-form" action="">
                                            <input class="c-form__input_olx" placeholder="Link do oferty" type="text" id="olx_input_url" required>
                                            <label class="c-form__toggle_olx" for="checkbox_olx" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>


                                        <div class="checkboxx_olx_new">
                                        <input class="c-checkbox_new" type="checkbox" id="checkbox_olx_new">
                                        <div class="c-formContainer_new">
                                          <form class="c-form_new" action="">
                                            <input class="c-form__input_olx_new" placeholder="Link do oferty" type="text" id="olx_input_url_new" required>
                                            <label class="c-form__toggle_olx_new" for="checkbox_olx_new" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="olx_adding_need_update"  style="    line-height: 43px;    height: 43px; margin-left: 120px;">Popraw</div>
                                    <div class="added_date_by" style="position: absolute;  right: 0; float: right; di\splay: flex;  ">
                                    <div id="olx_adding_date" style="padding-right: 30; position:  relative; height: 43px; line-height: 43px;"></div>
                                    <div id="olx_adding_by" style="height: 43px; position: relative; line-height: 43px;">
                                        <img src="" id="olx_adding_by_avatar" />
                                        <div id="olx_adding_by_name"></div>
                                    </div>
                                    </div>

                                </div>



                                <div class="erli_adding" style="display: inline-flex; position: relative; width: 100%; margin-top: 30px;">
                                    <img src="https://www.kuponos.pl/wp-content/uploads/thumbs_dir/screenshot-2021-12-01-at-23-11-34-platforma-zakupowa-erli-pl-najlepsze-zakupy-erli-pl-1yqxdp6ojgmls2z38k7ul436np2dx6szdjypi6pql6p0.png" id="erli_adding_img" height="40px" />
                                    <div id="erli_adding_status" style="     min-width: 200px;   line-height: 43px;    height: 43px; margin-left: 30px;">
                                        <div class="checkboxxx_erli">
                                        <input class="c-checkbox"   type="checkbox" id="checkbox_erli">
                                        <div class="c-formContainer">
                                          <form class="c-form" action="">
                                            <input class="c-form__input_erli" placeholder="Link do oferty" type="text" id="erli_input_url" required>
                                            <label class="c-form__toggle_erli" for="checkbox_erli" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>


                                        <div class="checkboxx_erli_new">
                                        <input class="c-checkbox_new" type="checkbox" id="checkbox_erli_new">
                                        <div class="c-formContainer_new">
                                          <form class="c-form_new" action="">
                                            <input class="c-form__input_erli_new" placeholder="Link do oferty" type="text" id="erli_input_url_new" required>
                                            <label class="c-form__toggle_erli_new" for="checkbox_erli_new" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="erli_adding_need_update"  style="    line-height: 43px;    height: 43px; margin-left: 120px;">Popraw</div>
                                    <div class="added_date_by" style="position: absolute;  right: 0; float: right; di\splay: flex;  ">
                                    <div id="erli_adding_date" style="padding-right: 30; position:  relative; height: 43px; line-height: 43px;"></div>
                                    <div id="erli_adding_by" style="height: 43px; position: relative; line-height: 43px;">
                                        <img src="" id="erli_adding_by_avatar" />
                                        <div id="erli_adding_by_name"></div>
                                    </div>
                                    </div>

                                </div>



                                <div class="alione_adding" style="display: inline-flex; position: relative; width: 100%; margin-top: 30px;">
                                    <img src="https://i0.wp.com/alione.pl/wp-content/uploads/2022/02/alione_kontur_i_cien.png?resize=2048%2C913&ssl=1" id="alione_adding_img" height="40px" />
                                    <div id="alione_adding_status" style="     min-width: 200px;   line-height: 43px;    height: 43px; margin-left: 30px;">
                                        <div class="checkboxxx_alione">
                                        <input class="c-checkbox"   type="checkbox" id="checkbox_alione">
                                        <div class="c-formContainer">
                                          <form class="c-form" action="">
                                            <input class="c-form__input_alione" placeholder="Link do oferty" type="text" id="alione_input_url" required>
                                            <label class="c-form__toggle_alione" for="checkbox_alione" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>


                                        <div class="checkboxx_alione_new">
                                        <input class="c-checkbox_new" type="checkbox" id="checkbox_alione_new">
                                        <div class="c-formContainer_new">
                                          <form class="c-form_new" action="">
                                            <input class="c-form__input_alione_new" placeholder="Link do oferty" type="text" id="alione_input_url_new" required>
                                            <label class="c-form__toggle_alione_new" for="checkbox_alione_new" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="alione_adding_need_update"  style="    line-height: 43px;    height: 43px; margin-left: 120px;">Popraw</div>
                                    <div class="added_date_by" style="position: absolute;  right: 0; float: right; di\splay: flex;  ">
                                    <div id="alione_adding_date" style="padding-right: 30; position:  relative; height: 43px; line-height: 43px;"></div>
                                    <div id="alione_adding_by" style="height: 43px; position: relative; line-height: 43px;">
                                        <img src="" id="alione_adding_by_avatar" />
                                        <div id="alione_adding_by_name"></div>
                                    </div>
                                    </div>

                                </div>

                                <div class="sprzedajemy_adding" style="display: inline-flex; position: relative; width: 100%; margin-top: 30px;">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d6/Logo_sprzedajemy_RGB_300dpi.jpg/1024px-Logo_sprzedajemy_RGB_300dpi.jpg" id="sprzedajemy_adding_img" height="40px" />
                                    <div id="sprzedajemy_adding_status" style="     min-width: 200px;   line-height: 43px;    height: 43px; margin-left: 30px;">
                                        <div class="checkboxxx_sprzedajemy">
                                        <input class="c-checkbox"   type="checkbox" id="checkbox_sprzedajemy">
                                        <div class="c-formContainer">
                                          <form class="c-form" action="">
                                            <input class="c-form__input_sprzedajemy" placeholder="Link do oferty" type="text" id="sprzedajemy_input_url" required>
                                            <label class="c-form__toggle_sprzedajemy" for="checkbox_sprzedajemy" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>


                                        <div class="checkboxx_sprzedajemy_new">
                                        <input class="c-checkbox_new" type="checkbox" id="checkbox_sprzedajemy_new">
                                        <div class="c-formContainer_new">
                                          <form class="c-form_new" action="">
                                            <input class="c-form__input_sprzedajemy_new" placeholder="Link do oferty" type="text" id="sprzedajemy_input_url_new" required>
                                            <label class="c-form__toggle_sprzedajemy_new" for="checkbox_sprzedajemy_new" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="sprzedajemy_adding_need_update"  style="    line-height: 43px;    height: 43px; margin-left: 120px;">Popraw</div>
                                    <div class="added_date_by" style="position: absolute;  right: 0; float: right; di\splay: flex;  ">
                                    <div id="sprzedajemy_adding_date" style="padding-right: 30; position:  relative; height: 43px; line-height: 43px;"></div>
                                    <div id="sprzedajemy_adding_by" style="height: 43px; position: relative; line-height: 43px;">
                                        <img src="" id="sprzedajemy_adding_by_avatar" />
                                        <div id="sprzedajemy_adding_by_name"></div>
                                    </div>
                                    </div>

                                </div>


                                <div class="shopee_adding" style="display: inline-flex; position: relative; width: 100%; margin-top: 30px;">
                                    <img src="https://www.nicepng.com/png/detail/983-9832058_shopee-logo-shopee-logo-vector.png" id="shopee_adding_img" height="40px" />
                                    <div id="shopee_adding_status" style="     min-width: 200px;   line-height: 43px;    height: 43px; margin-left: 30px;">
                                        <div class="checkboxxx_shopee">
                                        <input class="c-checkbox"   type="checkbox" id="checkbox_shopee">
                                        <div class="c-formContainer">
                                          <form class="c-form" action="">
                                            <input class="c-form__input_shopee" placeholder="Link do oferty" type="text" id="shopee_input_url" required>
                                            <label class="c-form__toggle_shopee" for="checkbox_shopee" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>


                                        <div class="checkboxx_shopee_new">
                                        <input class="c-checkbox_new" type="checkbox" id="checkbox_shopee_new">
                                        <div class="c-formContainer_new">
                                          <form class="c-form_new" action="">
                                            <input class="c-form__input_shopee_new" placeholder="Link do oferty" type="text" id="shopee_input_url_new" required>
                                            <label class="c-form__toggle_shopee_new" for="checkbox_shopee_new" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="shopee_adding_need_update"  style="    line-height: 43px;    height: 43px; margin-left: 120px;">Popraw</div>
                                    <div class="added_date_by" style="position: absolute;  right: 0; float: right; di\splay: flex;  ">
                                    <div id="shopee_adding_date" style="padding-right: 30; position:  relative; height: 43px; line-height: 43px;"></div>
                                    <div id="shopee_adding_by" style="height: 43px; position: relative; line-height: 43px;">
                                        <img src="" id="shopee_adding_by_avatar" />
                                        <div id="shopee_adding_by_name"></div>
                                    </div>
                                    </div>

                                </div>

                                <div class="google_adding" style="display: inline-flex; position: relative; width: 100%; margin-top: 30px;">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/2560px-Google_2015_logo.svg.png" id="google_adding_img" height="40px" />
                                    <div id="google_adding_status" style="     min-width: 200px;   line-height: 43px;    height: 43px; margin-left: 30px;">
                                        <div class="checkboxxx_google">
                                        <input class="c-checkbox"   type="checkbox" id="checkbox_google">
                                        <div class="c-formContainer">
                                          <form class="c-form" action="">
                                            <input class="c-form__input_google" placeholder="Link do oferty" type="text" id="google_input_url" required>
                                            <label class="c-form__toggle_google" for="checkbox_google" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>


                                        <div class="checkboxx_google_new">
                                        <input class="c-checkbox_new" type="checkbox" id="checkbox_google_new">
                                        <div class="c-formContainer_new">
                                          <form class="c-form_new" action="">
                                            <input class="c-form__input_google_new" placeholder="Link do oferty" type="text" id="google_input_url_new" required>
                                            <label class="c-form__toggle_google_new" for="checkbox_google_new" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="google_adding_need_update"  style="    line-height: 43px;    height: 43px; margin-left: 120px;">Popraw</div>
                                    <div class="added_date_by" style="position: absolute;  right: 0; float: right; di\splay: flex;  ">
                                    <div id="google_adding_date" style="padding-right: 30; position:  relative; height: 43px; line-height: 43px;"></div>
                                    <div id="google_adding_by" style="height: 43px; position: relative; line-height: 43px;">
                                        <img src="" id="google_adding_by_avatar" />
                                        <div id="google_adding_by_name"></div>
                                    </div>
                                    </div>

                                </div>

                                                                <div class="fb_marketplace_adding" style="display: inline-flex; position: relative; width: 100%; margin-top: 30px;">
                                    <img src="https://thumbs.dreamstime.com/b/ilustracja-wektora-logo-rynku-facebook-marzec-to-popularny-serwis-spo%C5%82eczno%C5%9Bciowy-214289295.jpg" id="fb_marketplace_adding_img" height="40px" />
                                    <div id="fb_marketplace_adding_status" style="     min-width: 200px;   line-height: 43px;    height: 43px; margin-left: 30px;">
                                        <div class="checkboxxx_fb_marketplace">
                                        <input class="c-checkbox"   type="checkbox" id="checkbox_fb_marketplace">
                                        <div class="c-formContainer">
                                          <form class="c-form" action="">
                                            <input class="c-form__input_fb_marketplace" placeholder="Link do oferty" type="text" id="fb_marketplace_input_url" required>
                                            <label class="c-form__toggle_fb_marketplace" for="checkbox_fb_marketplace" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>


                                        <div class="checkboxx_fb_marketplace_new">
                                        <input class="c-checkbox_new" type="checkbox" id="checkbox_fb_marketplace_new">
                                        <div class="c-formContainer_new">
                                          <form class="c-form_new" action="">
                                            <input class="c-form__input_fb_marketplace_new" placeholder="Link do oferty" type="text" id="fb_marketplace_input_url_new" required>
                                            <label class="c-form__toggle_fb_marketplace_new" for="checkbox_fb_marketplace_new" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="fb_marketplace_adding_need_update"  style="    line-height: 43px;    height: 43px; margin-left: 120px;">Popraw</div>
                                    <div class="added_date_by" style="position: absolute;  right: 0; float: right; di\splay: flex;  ">
                                    <div id="fb_marketplace_adding_date" style="padding-right: 30; position:  relative; height: 43px; line-height: 43px;"></div>
                                    <div id="fb_marketplace_adding_by" style="height: 43px; position: relative; line-height: 43px;">
                                        <img src="" id="fb_marketplace_adding_by_avatar" />
                                        <div id="fb_marketplace_adding_by_name"></div>
                                    </div>
                                    </div>

                                </div>

                                <div class="pinterest_adding" style="display: inline-flex; position: relative; width: 100%; margin-top: 30px;">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/Pinterest_Logo.svg/2560px-Pinterest_Logo.svg.png" id="pinterest_adding_img" height="40px" />
                                    <div id="pinterest_adding_status" style="     min-width: 200px;   line-height: 43px;    height: 43px; margin-left: 30px;">
                                        <div class="checkboxxx_pinterest">
                                        <input class="c-checkbox"   type="checkbox" id="checkbox_pinterest">
                                        <div class="c-formContainer">
                                          <form class="c-form" action="">
                                            <input class="c-form__input_pinterest" placeholder="Link do oferty" type="text" id="pinterest_input_url" required>
                                            <label class="c-form__toggle_pinterest" for="checkbox_pinterest" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>


                                        <div class="checkboxx_pinterest_new">
                                        <input class="c-checkbox_new" type="checkbox" id="checkbox_pinterest_new">
                                        <div class="c-formContainer_new">
                                          <form class="c-form_new" action="">
                                            <input class="c-form__input_pinterest_new" placeholder="Link do oferty" type="text" id="pinterest_input_url_new" required>
                                            <label class="c-form__toggle_pinterest_new" for="checkbox_pinterest_new" data-title="Dodaj link"></label>
                                          </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div id="pinterest_adding_need_update"  style="    line-height: 43px;    height: 43px; margin-left: 120px;">Popraw</div>
                                    <div class="added_date_by" style="position: absolute;  right: 0; float: right; di\splay: flex;  ">
                                    <div id="pinterest_adding_date" style="padding-right: 30; position:  relative; height: 43px; line-height: 43px;"></div>
                                    <div id="pinterest_adding_by" style="height: 43px; position: relative; line-height: 43px;">
                                        <img src="" id="pinterest_adding_by_avatar" />
                                        <div id="pinterest_adding_by_name"></div>
                                    </div>
                                    </div>

                                </div>

                    </div>
                </div>
            </div>
            <div class="sc-grVGCS sc-KfMfS hauPWX gdYlRc"><button class="sc-hKMtZM rWXjW" id="cancel_product_info_modal">Anuluj</button><button id="" class="sc-hKMtZM cGrIMx add_product_info_button">Zaktualizuj</button></div>
        </div>
    </div>
</div>


  <script src="require.js"></script>


<script>
var price_max;
var price;
var product_price_decimal;
var source;
var product_url;
var source_url;
var clicked_url = false;
var source_quantity = '0';
var variant = 'unset';
var source_shippment_from = '';
var source_price = '';
var source_shippment_price = '';
var source_shippment_time = '';
var suggested_title = '';
var new_title = '';
$(".eqUDzr").on('click', function(){
$(".shipping_time_choose").removeClass("radio_clicked");
$(this).find(".jLcNAu").addClass("radio_clicked");
$(this).find('[type=radio]:checked').prop('checked', false);
    $(this).find('[type=radio]').prop('checked', 'checked'); 

});
$(".rJDAdk").on('click', function(){
$(".shipping_price_choose").removeClass("radio_clicked");
$(this).find(".jLcNAu").addClass("radio_clicked");
$(this).find('[type=radio]:checked').prop('checked', false);
    $(this).find('[type=radio]').prop('checked', 'checked'); 

});

$(".add_product_info_button").on('click', function(){
   var this_id = $(".add_product_info_button").attr('id');
   var user_id = '<?php echo $_SESSION["id"]; ?>';
   var price = $("#product_info_price_modal").text();
   var comments = $("#comments").val();
    new_title = $("#input_info_title_new").val();
   if (new_title == ''){
    new_title = '0';
   }

   var source_shippment_price = $("input[name='shippingUnderFilter_info']:checked").val();
   var source_shippment_from = $(".hdxmeq_active").attr('value-ship');
   var source_shippment_time = $("input[name='shippingTimeFilter_info']:checked").val();





   var allegro_url = $("#allegro_input_url").val();
   if (allegro_url === undefined || allegro_url == null || allegro_url.length <= 0)
   {
    allegro_url =  $("#allegro_input_url_new").val();
   }
   else{
    allegro_added_by = user_id;
   }
   var olx_url = $("#olx_input_url").val();
    if (olx_url === undefined || olx_url == null || olx_url.length <= 0)
   {
    olx_url =  $("#olx_input_url_new").val();
   } 
   var erli_url = $("#erli_input_url").val();
    if (erli_url === undefined || erli_url == null || erli_url.length <= 0)
   {
    erli_url =  $("#erli_input_url_new").val();
   }  
   var alione_url = $("#alione_input_url").val();
    if (alione_url === undefined || alione_url == null || alione_url.length <= 0)
   {
    alione_url =  $("#alione_input_url_new").val();
   } 

   var sprzedajemy_url = $("#sprzedajemy_input_url").val();
     if (sprzedajemy_url === undefined || sprzedajemy_url == null || sprzedajemy_url.length <= 0)
   {
    sprzedajemy_url =  $("#sprzedajemy_input_url_new").val();
   }   
   var shopee_url = $("#shopee_input_url").val();
       if (shopee_url === undefined || shopee_url == null || shopee_url.length <= 0)
   {
    shopee_url =  $("#shopee_input_url_new").val();
   }  
   var google_url = $("#google_input_url").val();
     if (google_url === undefined || google_url == null || google_url.length <= 0)
   {
    google_url =  $("#google_input_url_new").val();
   } 
   var fb_marketplace_url = $("#fb_marketplace_input_url").val();
        if (fb_marketplace_url === undefined || fb_marketplace_url == null || fb_marketplace_url.length <= 0)
   {
    fb_marketplace_url =  $("#fb_marketplace_input_url_new").val();
   } 
   var pinterest_url = $("#pinterest_input_url").val();
           if (pinterest_url === undefined || pinterest_url == null || pinterest_url.length <= 0)
   {
    pinterest_url =  $("#pinterest_input_url_new").val();
   } 
             $.ajax({
                    url : 'update_product_data.php',
                    type : 'POST',
                    data : {id: this_id, datatype: "id", user_id: user_id, source_shippment_price: source_shippment_price, source_shippment_time: source_shippment_time, source_shippment_from: source_shippment_from, price: price, comments:comments, new_title: new_title, allegro_url: allegro_url, olx_url: olx_url, erli_url: erli_url, alione_url: alione_url, sprzedajemy_url: sprzedajemy_url, shopee_url: shopee_url, google_url: google_url, fb_marketplace_url: fb_marketplace_url, pinterest_url: pinterest_url},
                    success : function (result) {
                         alertify.confirm().set({ delay: 170000 });
                           alertify.success("Zaktualizowano pomyślnie.");
                            $(".ProductInfoModal").hide();

                    },
                    error: function (result) {
                         alertify.confirm().set({ delay: 170000 });
                           alertify.error("Wystapił błąd. Spróbuj ponownie.");

                    },
                  });

});

  $("#copy_suggested_title").click(function(){
  var copyText = document.getElementById("input_info_title_new");
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices
  navigator.clipboard.writeText(copyText.value);

   alertify.confirm().set({ delay: 170000 });
   alertify.success("Skopiowano.");

  });

                    var once = false;

$(".productt").on('click', function(){
   var this_id = $(this).attr('id');
             $.ajax({
                    url : 'get_product_data.php',
                    type : 'POST',
                    data : {id: this_id, datatype: "id"},
                    dataType : 'json',
                    success : function (result) {
                       // console.log(result);







                       $(".add_product_info_button").attr("id",this_id);
                       $(".after_url_info").css("display", "flex");
                       $(".after_url_info2").css("display", "block");
                       $("#product_info_img_modal").attr("src",result['image']);
                       $("#product_info_title_modal").text(result['title']);
                       $("#product_info_title_new_modal").text(result['suggested_title']);
                       $("#product_info_price_min_modal").text(result['source_price']);     
                        $("#product_info_title_id_modal").text("#"+this_id);
                    suggested_title = result['suggested_title'];
                                            if (suggested_title != 0){
                                            $('#input_info_title_new').val(suggested_title);
                                            }
                        if (result['variant'] == "null" || result['variant'] == "unset"){
                          $(".variablesTitle_info").css("display", "none");
                          $(".variablesModal_info").css("display", "none");
                        }
                        else{
                          $(".variablesTitle_info").css("display", "block");
                          $(".variablesModal_info").css("display", "block");             
                        }

                       price_max = (result['source_price']*2) - (result['source_price']/3);
                       var product_price_max_decimal = parseFloat(price_max).toFixed(2);
                       $("#product_info_price_max_modal").text(product_price_max_decimal);     
                       price = result['source_price'];
                       var product_price_new = result['source_price'] * 1;
                       var product_price_pre = result['source_price'] * 0.45;
                       var product_price = product_price_new + product_price_pre;
                       product_price_decimal = parseFloat(product_price).toFixed(2);

                       var price_count_all = (parseFloat(result['price']) + parseFloat(price_max)).toFixed(2);
                       var price_count = (result['source_price'] / price_count_all) * 100;
                       var price_percent = parseFloat(price_count).toFixed(2);
                       $('#current-value_info').html('<span id="product_info_price_modal">'+result['price']+'</span>');
                       $('#suggested_price').css({'display': 'block'});
                       $('#suggested_price_zl').css({'display': 'block'});

                       
                       $('#suggested_price').text(result['price']);
                       $('#current-value_info').css({'display': 'none'});
                       $('[type="range"]').attr('min', result['source_price']);
                       $('[type="range"]').attr('max', price_max);
                       $('[type="range"]').attr('value', result['price']);
                       $('[type="range"]').attr('step', "0.01");
                        source_shippment_from = result['source_shippment_from'];

                        $('#product_title_new_modal').text('Utwórz');


                                              if (result['source_shippment_from'] == "pl"){
                                                $("#china_ship_info").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").removeClass("hdxmeq_active");
                                                $("#poland_ship_info").addClass("hdxmeq_active");
                                              }
                                              else if (result['source_shippment_from'] == "ch"){
                                                $("#poland_ship_info").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").removeClass("hdxmeq_active");
                                                $("#china_ship_info").addClass("hdxmeq_active");
                                              }
                                              else if (result['source_shippment_from'] == "de"){
                                                $("#china_ship_info").removeClass("hdxmeq_active");
                                                $("#poland_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").addClass("hdxmeq_active");
                                              }
                                              else if (result['source_shippment_from'] == "fr"){
                                                $("#china_ship_info").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").removeClass("hdxmeq_active");
                                                $("#poland_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").addClass("hdxmeq_active");
                                              }
                                              else if (result['source_shippment_from'] == "cz"){
                                                $("#china_shi_infop").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").removeClass("hdxmeq_active");
                                                $("#poland_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").addClass("hdxmeq_active");
                                              }



                                              $("#poland_ship_info").click(function(){
                                                $("#china_ship_info").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").removeClass("hdxmeq_active");
                                                $("#poland_ship_info").addClass("hdxmeq_active");
                                                source_shippment_from = "pl";
                                              });

                                              $("#china_ship_info").click(function(){
                                                $("#poland_ship_info").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").removeClass("hdxmeq_active");
                                                $("#china_ship_info").addClass("hdxmeq_active");
                                                source_shippment_from = "ch";
                                              });

                                              $("#germany_ship_info").click(function(){
                                                $("#china_ship_info").removeClass("hdxmeq_active");
                                                $("#poland_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").addClass("hdxmeq_active");
                                                source_shippment_from = "de";
                                              });


                                              $("#france_ship_info").click(function(){
                                                $("#china_ship_info").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").removeClass("hdxmeq_active");
                                                $("#poland_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").addClass("hdxmeq_active");
                                                source_shippment_from = "fr";
                                              });

                                              $("#czech_ship_info").click(function(){
                                                $("#china_ship_info").removeClass("hdxmeq_active");
                                                $("#germany_ship_info").removeClass("hdxmeq_active");
                                                $("#france_ship_info").removeClass("hdxmeq_active");
                                                $("#poland_ship_info").removeClass("hdxmeq_active");
                                                $("#czech_ship_info").addClass("hdxmeq_active");
                                                source_shippment_from = "cz";
                                              });
                       

                                          if (result['free_shippment'] == "free"){
                                                   source_shippment_time = $("input[name='shippingTimeFilter_info']:checked").val();
                                                  $("#free_shippment_span_info").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#free_shippment_span_info").addClass("radio_clicked");

                                            }

                                            if (result['source_shippment_time'] == "1-3"){
                                                   $(".shipping_time_choose").removeClass("radio_clicked");
                                                  $("#4_7_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#1_3_day_shippment_span_info").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#1_3_day_shippment_span_info").addClass("radio_clicked");
                                            }
                                            else if (result['source_shippment_time'] == "4-7"){
                                             $("#1_3_day_shippment_span_info").removeClass("radio_clicked");
                                                   $(".shipping_time_choose").removeClass("radio_clicked");

                                                  $("#1_3_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                   $("#12_15_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);


                                                   $("#4_7_day_shippment_span_info").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#4_7_day_shippment_span_info").addClass("radio_clicked");
                                            }
                                            else if (result['source_shippment_time'] == "8-11"){
                                                   $(".shipping_time_choose").removeClass("radio_clicked");
                                                  $("#1_3_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                 $("#12_15_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);   
                                                   $("#8_11_day_shippment_span_info").parent().find('[type=radio]').prop('checked', 'checked'); 

                                             $("#8_11_day_shippment_span_info").addClass("radio_clicked");
                                            }
                                            else if (result['source_shippment_time'] == "12-15"){
                                                   $(".shipping_time_choose").removeClass("radio_clicked");
$("#1_3_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                 $("#8_11_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);   

                                                                                                    $("#12_15_day_shippment_span_info").parent().find('[type=radio]').prop('checked', 'checked'); 

                                             $("#12_15_day_shippment_span_info").addClass("radio_clicked");
                                            }
                                            else if (result['source_shippment_time'] == "16-25"){
                                                   $(".shipping_time_choose").removeClass("radio_clicked");
$("#1_3_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                 $("#8_11_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);  
                                                                                                    $("#16_25_day_shippment_span_info").parent().find('[type=radio]').prop('checked', 'checked'); 

                                             $("#16_25_day_shippment_span_info").addClass("radio_clicked");
                                            }
                                           else{
                                                   $(".shipping_time_choose").removeClass("radio_clicked");
$("#1_3_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                 $("#8_11_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span_info").parent().find('[type=radio]:checked').prop('checked', false);  
                                                                                                    $("#25_day_shippment_span_info").parent().find('[type=radio]').prop('checked', 'checked'); 

                                             $("#25_day_shippment_span_info").addClass("radio_clicked");
                                            }

                                            setTimeout(updateTooltip(), 500); 


                        var comments = result['comments'];
                            if ((result['comments'] == "") || (result['comments'] == "null")){
                                $("#comments_info").val();
                            }
                            else{
                                $("#comments_info").val(comments);
                            }

                        if ((result['added_allegro'] == '') || (result['added_allegro'] == '0')){
                         $('.checkboxxx_allegro').hide();  
                         $('.checkboxx_allegro_new').show();  
                         $('.c-form__input_allegro').hide();
                         $('.c-form__toggle_allegro').hide();
                         $('.c-form__input_allegro_new').show();
                         $('.c-form__toggle_allegro_new').show();
                         $('#allegro_adding_img').css('filter', 'grayscale(100%)');
                         $('#allegro_adding_need_update').hide();
                         $('#allegro_adding_date').hide();
                         $('#allegro_adding_by').hide();

                        }
                        else{
                         $('.checkboxx_allegro_new').hide();  
                         $('.checkboxxx_allegro').show();  
                         $('.c-form__input_allegro_new').hide();
                         $('.c-form__toggle_allegro_new').hide();
                         $('.c-form__input_allegro').show();
                         $('.c-form__toggle_allegro').show();
                         $("#allegro_input_url").val(result['added_allegro']);
                         $('#allegro_adding_img').css('filter', 'grayscale(0%)');
                         var added_allegro_date = result['added_allegro_date'];
                          added_allegro_date = added_allegro_date.substring(0, added_allegro_date.length-3);
                         $('#allegro_adding_date').text(added_allegro_date);
                         if (result['added_allegro_by'] == 0){
                          $("#allegro_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/barcik.jpeg');
                         }
                         else if (result['added_allegro_by'] == 1){
                          $("#allegro_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/olorek.jpeg');
                         }
                         else if (result['added_allegro_by'] == 2){
                          $("#allegro_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/pisiurek.jpeg');
                         }
                         else if (result['added_allegro_by'] == 3){
                          $("#allegro_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/dzejkob.jpeg');
                         } 
                         else if (result['added_allegro_by'] == 4){
                          $("#allegro_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/felipe.jpeg');
                         }
                         if (clicked_url == false){
                          $( ".c-form__toggle_allegro").click();
                         }
                           if ((result['need_update_allegro'] == '') || (result['need_update_allegro'] == '0')){
                             $('#allegro_adding_need_update').hide();
                           }
                           else{
                            $('#allegro_adding_need_update').show();
                           }

                         $('#allegro_adding_date').show();
                         $('#allegro_adding_by').show();
                        }
                        //add_olx

                        if ((result['added_olx'] == '') || (result['added_olx'] == '0')){
                         $('.checkboxxx_olx').hide();  
                         $('.checkboxx_olx_new').show();  
                         $('.c-form__input_olx').hide();
                         $('.c-form__toggle_olx_new').hide();
                         $('.c-form__input_olx_new').show();
                         $('.c-form__toggle_olx_new').show();
                         $('#olx_adding_img').css('filter', 'grayscale(100%)');
                         $('#olx_adding_need_update').hide();
                         $('#olx_adding_date').hide();
                         $('#olx_adding_by').hide();

                        }
                        else{
                         $('#checkboxx_olx_new').hide();  
                         $('#checkboxxx_olx').show();  
                         $('#c-form__input_a_olx_new').hide();
                         $('#c-form__toggle_olx_new').hide();
                         $('#c-form__input_olx').show();
                         $('#c-form__toggle_olx').show();
                         $("#olx_input_url").val(result['added_olx']);
                         $('#olx_adding_img').css('filter', 'grayscale(0%)');
                         var added_olx_date = result['added_olx_date'];
                          added_olx_date = added_olx_date.substring(0, added_olx_date.length-3);
                         $('#olx_adding_date').text(added_olx_date);                         $



                         if (result['added_olx_by'] == 0){
                          $("#olx_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/barcik.jpeg');
                         }
                         else if (result['added_olx_by'] == 1){
                          $("#olx_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/olorek.jpeg');
                         }
                         else if (result['added_olx_by'] == 2){
                          $("#olx_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/pisiurek.jpeg');
                         }
                         else if (result['added_olx_by'] == 3){
                          $("#olx_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/dzejkob.jpeg');
                         } 
                         else if (result['added_olx_by'] == 4){
                          $("#olx_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/felipe.jpeg');
                         }
                                                  if (clicked_url == false){
                          $( ".c-form__toggle_olx").click();
                         }
                           if ((result['need_update_olx'] == '') || (result['need_update_olx'] == '0')){
                             $('#olx_adding_need_update').hide();
                           }
                           else{
                            $('#olx_adding_need_update').show();
                           }

                         $('#olx_adding_date').show();
                         $('#olx_adding_by').show();
                        }

                        //add_erli

                        if ((result['added_erli'] == '') || (result['added_erli'] == '0')){
                         $('.checkboxxx_erli').hide();  
                         $('.checkboxx_erli_new').show();  
                         $('.c-form__input_erli').hide();
                         $('.c-form__toggle_erli_new').hide();
                         $('.c-form__input_erli_new').show();
                         $('.c-form__toggle_erli_new').show();
                         $('#erli_adding_img').css('filter', 'grayscale(100%)');
                         $('#erli_adding_need_update').hide();
                         $('#erli_adding_date').hide();
                         $('#erli_adding_by').hide();

                        }
                        else{
                         $('#checkboxx_erli_new').hide();  
                         $('#checkboxxx_erli').show();  
                         $('#c-form__input_erli_new').hide();
                         $('#c-form__toggle_erli_new').hide();
                         $('#c-form__input_erli').show();
                         $('#c-form__toggle_erli').show();
                         $("#erli_input_url").val(result['added_erli']);
                         $('#erli_adding_img').css('filter', 'grayscale(0%)');
                         var added_erli_date = result['added_erli_date'];
                          added_erli_date = added_erli_date.substring(0, added_erli_date.length-3);
                         $('#erli_adding_date').text(added_erli_date);    
                         if (result['added_erli_by'] == 0){
                          $("#erli_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/barcik.jpeg');
                         }
                         else if (result['added_erli_by'] == 1){
                          $("#erli_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/olorek.jpeg');
                         }
                         else if (result['added_erli_by'] == 2){
                          $("#erli_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/pisiurek.jpeg');
                         }
                         else if (result['added_erli_by'] == 3){
                          $("#erli_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/dzejkob.jpeg');
                         } 
                         else if (result['added_erli_by'] == 4){
                          $("#erli_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/felipe.jpeg');
                         }
                                                  if (clicked_url == false){
                          $( ".c-form__toggle_erli").click();
                         }
                           if ((result['need_update_erli'] == '') || (result['need_update_erli'] == '0')){
                             $('#erli_adding_need_update').hide();
                           }
                           else{
                            $('#erli_adding_need_update').show();
                           }

                         $('#erli_adding_date').show();
                         $('#erli_adding_by').show();
                        }



                        //add_alione

                        if ((result['added_alione'] == '') || (result['added_alione'] == '0')){
                         $('.checkboxxx_alione').hide();  
                         $('.checkboxx_alione_new').show();  
                         $('.c-form__input_alione').hide();
                         $('.c-form__toggle_alione_new').hide();
                         $('.c-form__input_alione_new').show();
                         $('.c-form__toggle_alione_new').show();
                         $('#alione_adding_img').css('filter', 'grayscale(100%)');
                         $('#alione_adding_need_update').hide();
                         $('#alione_adding_date').hide();
                         $('#alione_adding_by').hide();

                        }
                        else{
                         $('#checkboxx_alione_new').hide();  
                         $('#checkboxxx_alione').show();  
                         $('#c-form__input_alione_new').hide();
                         $('#c-form__toggle_alione_new').hide();
                         $('#c-form__input_alione').show();
                         $('#c-form__toggle_alione').show();
                         $("#alione_input_url").val(result['added_alione']);
                         $('#alione_adding_img').css('filter', 'grayscale(0%)');
                         var added_alione_date = result['added_alione_date'];
                          added_alione_date = added_alione_date.substring(0, added_alione_date.length-3);
                         $('#alione_adding_date').text(added_alione_date); 
                                                  if (result['added_alione_by'] == 0){
                          $("#alione_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/barcik.jpeg');
                         }
                         else if (result['added_alione_by'] == 1){
                          $("#alione_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/olorek.jpeg');
                         }
                         else if (result['added_alione_by'] == 2){
                          $("#alione_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/pisiurek.jpeg');
                         }
                         else if (result['added_alione_by'] == 3){
                          $("#alione_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/dzejkob.jpeg');
                         } 
                         else if (result['added_alione_by'] == 4){
                          $("#alione_adding_by_avatar").attr('src', 'https://alione.pl/platform/images/felipe.jpeg');
                         }
                         if (clicked_url == false){
                          $( ".c-form__toggle_alione").click();
                         }
                           if ((result['need_update_alione'] == '') || (result['need_update_alione'] == '0')){
                             $('#alione_adding_need_update').hide();
                           }
                           else{
                            $('#alione_adding_need_update').show();
                           }

                         $('#alione_adding_date').show();
                         $('#alione_adding_by').show();
                        }


                        //add_sprzedajemy

                        if ((result['added_sprzedajemy'] == '') || (result['added_sprzedajemy'] == '0')){
                         $('.checkboxxx_sprzedajemy').hide();  
                         $('.checkboxx_sprzedajemy_new').show();  
                         $('.c-form__input_sprzedajemy').hide();
                         $('.c-form__toggle_sprzedajemy_new').hide();
                         $('.c-form__input_sprzedajemy_new').show();
                         $('.c-form__toggle_sprzedajemy_new').show();
                         $('#sprzedajemy_adding_img').css('filter', 'grayscale(100%)');
                         $('#sprzedajemy_adding_need_update').hide();
                         $('#sprzedajemy_adding_date').hide();
                         $('#sprzedajemy_adding_by').hide();

                        }
                        else{
                         $('#checkboxx_sprzedajemy_new').hide();  
                         $('#checkboxxx_sprzedajemy').show();  
                         $('#c-form__input_sprzedajemy_new').hide();
                         $('#c-form__toggle_sprzedajemy_new').hide();
                         $('#c-form__input_sprzedajemy').show();
                         $('#c-form__toggle_sprzedajemy').show();
                         $("#sprzedajemy_input_url").val(result['added_sprzedajemy']);
                         $('#sprzedajemy_adding_img').css('filter', 'grayscale(0%)');
                         var added_sprzedajemy_date = result['added_sprzedajemy_date'];
                          added_sprzedajemy_date = added_sprzedajemy_date.substring(0, added_sprzedajemy_date.length-3);
                         $('#sprzedajemy_adding_date').text(added_sprzedajemy_date);
                                                  if (result['added_sprzedajemy_by'] == 0){
                          $("#sprzedajemy_adding_by_avatar").attr('src', 'https://sprzedajemy.pl/platform/images/barcik.jpeg');
                         }
                         else if (result['added_sprzedajemy_by'] == 1){
                          $("#sprzedajemy_adding_by_avatar").attr('src', 'https://sprzedajemy.pl/platform/images/olorek.jpeg');
                         }
                         else if (result['added_sprzedajemy_by'] == 2){
                          $("#sprzedajemy_adding_by_avatar").attr('src', 'https://sprzedajemy.pl/platform/images/pisiurek.jpeg');
                         }
                         else if (result['added_sprzedajemy_by'] == 3){
                          $("#sprzedajemy_adding_by_avatar").attr('src', 'https://sprzedajemy.pl/platform/images/dzejkob.jpeg');
                         } 
                         else if (result['added_sprzedajemy_by'] == 4){
                          $("#sprzedajemy_adding_by_avatar").attr('src', 'https://sprzedajemy.pl/platform/images/felipe.jpeg');
                         }
                         if (clicked_url == false){
                          $( ".c-form__toggle_sprzedajemy").click();
                         }
                           if ((result['need_update_sprzedajemy'] == '') || (result['need_update_sprzedajemy'] == '0')){
                             $('#sprzedajemy_adding_need_update').hide();
                           }
                           else{
                            $('#sprzedajemy_adding_need_update').show();
                           }

                         $('#sprzedajemy_adding_date').show();
                         $('#sprzedajemy_adding_by').show();
                        }


                        //add_shopee

                        if ((result['added_shopee'] == '') || (result['added_shopee'] == '0')){
                         $('.checkboxxx_shopee').hide();  
                         $('.checkboxx_shopee_new').show();  
                         $('.c-form__input_shopee').hide();
                         $('.c-form__toggle_shopee_new').hide();
                         $('.c-form__input_shopee_new').show();
                         $('.c-form__toggle_shopee_new').show();
                         $('#shopee_adding_img').css('filter', 'grayscale(100%)');
                         $('#shopee_adding_need_update').hide();
                         $('#shopee_adding_date').hide();
                         $('#shopee_adding_by').hide();

                        }
                        else{
                         $('#checkboxx_shopee_new').hide();  
                         $('#checkboxxx_shopee').show();  
                         $('#c-form__input_shopee_new').hide();
                         $('#c-form__toggle_shopee_new').hide();
                         $('#c-form__input_shopee').show();
                         $('#c-form__toggle_shopee').show();
                         $("#shopee_input_url").val(result['added_shopee']);
                         $('#shopee_adding_img').css('filter', 'grayscale(0%)');
                         var added_shopee_date = result['added_shopee_date'];
                          added_shopee_date = added_shopee_date.substring(0, added_shopee_date.length-3);
                         $('#shopee_adding_date').text(added_shopee_date);
                                                  if (result['added_shopee_by'] == 0){
                          $("#shopee_adding_by_avatar").attr('src', 'https://shopee.pl/platform/images/barcik.jpeg');
                         }
                         else if (result['added_shopee_by'] == 1){
                          $("#shopee_adding_by_avatar").attr('src', 'https://shopee.pl/platform/images/olorek.jpeg');
                         }
                         else if (result['added_shopee_by'] == 2){
                          $("#shopee_adding_by_avatar").attr('src', 'https://shopee.pl/platform/images/pisiurek.jpeg');
                         }
                         else if (result['added_shopee_by'] == 3){
                          $("#shopee_adding_by_avatar").attr('src', 'https://shopee.pl/platform/images/dzejkob.jpeg');
                         } 
                         else if (result['added_shopee_by'] == 4){
                          $("#shopee_adding_by_avatar").attr('src', 'https://shopee.pl/platform/images/felipe.jpeg');
                         }
                         if (clicked_url == false){
                          $( ".c-form__toggle_shopee").click();
                         }
                           if ((result['need_update_shopee'] == '') || (result['need_update_shopee'] == '0')){
                             $('#shopee_adding_need_update').hide();
                           }
                           else{
                            $('#shopee_adding_need_update').show();
                           }

                         $('#shopee_adding_date').show();
                         $('#shopee_adding_by').show();
                        }


                        //add_google

                        if ((result['added_google'] == '') || (result['added_google'] == '0')){
                         $('.checkboxxx_google').hide();  
                         $('.checkboxx_google_new').show();  
                         $('.c-form__input_google').hide();
                         $('.c-form__toggle_google_new').hide();
                         $('.c-form__input_google_new').show();
                         $('.c-form__toggle_google_new').show();
                         $('#google_adding_img').css('filter', 'grayscale(100%)');
                         $('#google_adding_need_update').hide();
                         $('#google_adding_date').hide();
                         $('#google_adding_by').hide();

                        }
                        else{
                         $('#checkboxx_google_new').hide();  
                         $('#checkboxxx_google').show();  
                         $('#c-form__input_google_new').hide();
                         $('#c-form__toggle_google_new').hide();
                         $('#c-form__input_google').show();
                         $('#c-form__toggle_google').show();
                         $("#google_input_url").val(result['added_google']);
                         $('#google_adding_img').css('filter', 'grayscale(0%)');
                         var added_google_date = result['added_google_date'];
                          added_google_date = added_google_date.substring(0, added_google_date.length-3);
                         $('#google_adding_date').text(added_google_date);
                                                  if (result['added_google_by'] == 0){
                          $("#google_adding_by_avatar").attr('src', 'https://google.pl/platform/images/barcik.jpeg');
                         }
                         else if (result['added_google_by'] == 1){
                          $("#google_adding_by_avatar").attr('src', 'https://google.pl/platform/images/olorek.jpeg');
                         }
                         else if (result['added_google_by'] == 2){
                          $("#google_adding_by_avatar").attr('src', 'https://google.pl/platform/images/pisiurek.jpeg');
                         }
                         else if (result['added_google_by'] == 3){
                          $("#google_adding_by_avatar").attr('src', 'https://google.pl/platform/images/dzejkob.jpeg');
                         } 
                         else if (result['added_google_by'] == 4){
                          $("#google_adding_by_avatar").attr('src', 'https://google.pl/platform/images/felipe.jpeg');
                         }
                         if (clicked_url == false){
                          $( ".c-form__toggle_google").click();
                         }
                           if ((result['need_update_google'] == '') || (result['need_update_google'] == '0')){
                             $('#google_adding_need_update').hide();
                           }
                           else{
                            $('#google_adding_need_update').show();
                           }

                         $('#google_adding_date').show();
                         $('#google_adding_by').show();
                        }


                        //add_fb_marketplace

                        if ((result['added_fb_marketplace'] == '') || (result['added_fb_marketplace'] == '0')){
                         $('.checkboxxx_fb_marketplace').hide();  
                         $('.checkboxx_fb_marketplace_new').show();  
                         $('.c-form__input_fb_marketplace').hide();
                         $('.c-form__toggle_fb_marketplace_new').hide();
                         $('.c-form__input_fb_marketplace_new').show();
                         $('.c-form__toggle_fb_marketplace_new').show();
                         $('#fb_marketplace_adding_img').css('filter', 'grayscale(100%)');
                         $('#fb_marketplace_adding_need_update').hide();
                         $('#fb_marketplace_adding_date').hide();
                         $('#fb_marketplace_adding_by').hide();

                        }
                        else{
                         $('#checkboxx_fb_marketplace_new').hide();  
                         $('#checkboxxx_fb_marketplace').show();  
                         $('#c-form__input_fb_marketplace_new').hide();
                         $('#c-form__toggle_fb_marketplace_new').hide();
                         $('#c-form__input_fb_marketplace').show();
                         $('#c-form__toggle_fb_marketplace').show();
                         $("#fb_marketplace_input_url").val(result['added_fb_marketplace']);
                         $('#fb_marketplace_adding_img').css('filter', 'grayscale(0%)');
                         var added_fb_marketplace_date = result['added_fb_marketplace_date'];
                          added_fb_marketplace_date = added_fb_marketplace_date.substring(0, added_fb_marketplace_date.length-3);
                         $('#fb_marketplace_adding_date').text(added_fb_marketplace_date); 
                                                  if (result['added_fb_marketplace_by'] == 0){
                          $("#fb_marketplace_adding_by_avatar").attr('src', 'https://fb_marketplace.pl/platform/images/barcik.jpeg');
                         }
                         else if (result['added_fb_marketplace_by'] == 1){
                          $("#fb_marketplace_adding_by_avatar").attr('src', 'https://fb_marketplace.pl/platform/images/olorek.jpeg');
                         }
                         else if (result['added_fb_marketplace_by'] == 2){
                          $("#fb_marketplace_adding_by_avatar").attr('src', 'https://fb_marketplace.pl/platform/images/pisiurek.jpeg');
                         }
                         else if (result['added_fb_marketplace_by'] == 3){
                          $("#fb_marketplace_adding_by_avatar").attr('src', 'https://fb_marketplace.pl/platform/images/dzejkob.jpeg');
                         } 
                         else if (result['added_fb_marketplace_by'] == 4){
                          $("#fb_marketplace_adding_by_avatar").attr('src', 'https://fb_marketplace.pl/platform/images/felipe.jpeg');
                         }
                         if (clicked_url == false){
                          $( ".c-form__toggle_fb_marketplace").click();
                         }
                           if ((result['need_update_fb_marketplace'] == '') || (result['need_update_fb_marketplace'] == '0')){
                             $('#fb_marketplace_adding_need_update').hide();
                           }
                           else{
                            $('#fb_marketplace_adding_need_update').show();
                           }

                         $('#fb_marketplace_adding_date').show();
                         $('#fb_marketplace_adding_by').show();
                        }



                        //add_pinterest

                        if ((result['added_pinterest'] == '') || (result['added_pinterest'] == '0')){
                         $('.checkboxxx_pinterest').hide();  
                         $('.checkboxx_pinterest_new').show();  
                         $('.c-form__input_pinterest').hide();
                         $('.c-form__toggle_pinterest_new').hide();
                         $('.c-form__input_pinterest_new').show();
                         $('.c-form__toggle_pinterest_new').show();
                         $('#pinterest_adding_img').css('filter', 'grayscale(100%)');
                         $('#pinterest_adding_need_update').hide();
                         $('#pinterest_adding_date').hide();
                         $('#pinterest_adding_by').hide();

                        }
                        else{
                         $('#checkboxx_pinterest_new').hide();  
                         $('#checkboxxx_pinterest').show();  
                         $('#c-form__input_pinterest_new').hide();
                         $('#c-form__toggle_pinterest_new').hide();
                         $('#c-form__input_pinterest').show();
                         $('#c-form__toggle_pinterest').show();
                         $("#pinterest_input_url").val(result['added_pinterest']);
                         $('#pinterest_adding_img').css('filter', 'grayscale(0%)');
                         var added_pinterest_date = result['added_pinterest_date'];
                          added_pinterest_date = added_pinterest_date.substring(0, added_pinterest_date.length-3);
                         $('#pinterest_adding_date').text(added_pinterest_date);
                                                  if (result['added_pinterest_by'] == 0){
                          $("#pinterest_adding_by_avatar").attr('src', 'https://pinterest.pl/platform/images/barcik.jpeg');
                         }
                         else if (result['added_pinterest_by'] == 1){
                          $("#pinterest_adding_by_avatar").attr('src', 'https://pinterest.pl/platform/images/olorek.jpeg');
                         }
                         else if (result['added_pinterest_by'] == 2){
                          $("#pinterest_adding_by_avatar").attr('src', 'https://pinterest.pl/platform/images/pisiurek.jpeg');
                         }
                         else if (result['added_pinterest_by'] == 3){
                          $("#pinterest_adding_by_avatar").attr('src', 'https://pinterest.pl/platform/images/dzejkob.jpeg');
                         } 
                         else if (result['added_pinterest_by'] == 4){
                          $("#pinterest_adding_by_avatar").attr('src', 'https://pinterest.pl/platform/images/felipe.jpeg');
                         }
                         if (clicked_url == false){
                          $( ".c-form__toggle_pinterest").click();
                         }
                           if ((result['need_update_pinterest'] == '') || (result['need_update_pinterest'] == '0')){
                             $('#pinterest_adding_need_update').hide();
                           }
                           else{
                            $('#pinterest_adding_need_update').show();
                           }

                         $('#pinterest_adding_date').show();
                         $('#pinterest_adding_by').show();
                        }
    source_shippment_time = $("input[name='shippingTimeFilter_info']:checked").val();






                      setTimeout(updateTooltip(), 100);

                    },
                    error : function (e) {
                       alert("Wystapił błąd.");
                    }
                }) 
   
       $(".ProductInfoModal").show();

});


$("#add_product_modal").on('click', function(){
    $(".addProductModal").show();
});
$("#close_product_modal").on('click', function(){
    $(".addProductModal").hide();
});
$("#close_product_data_modal").on('click', function(){
    $(".ProductInfoModal").hide();

   if($('.c-form__input_allegro').is(':visible')){
    clicked_url = false;
    }
    else{
    clicked_url = true;
    }
});
$("#cancel_product_modal").on('click', function(){
    $(".addProductModal").hide();
    $('#input_add_product_modal').val('');
    $(".after_url").hide();
});
function get_hostname(url) {
    var m = url.match(/^https:\/\/[^/]+/);
    return m ? m[0] : null;
}

///add_product_modal_changes
$('#input_add_product_modal').on('input', function() {
  once = false;
    product_url = $('#input_add_product_modal').val();
    if ( (product_url.indexOf('AG') == 0) || (product_url.indexOf('AK') == 0) || (product_url.indexOf('AB') == 0) || (product_url.indexOf('FT') == 0) || (product_url.indexOf('CA') == 0) || (product_url.indexOf('PS') == 0) || (product_url.indexOf('ZG') == 0) || (product_url.indexOf('OD') == 0) || (product_url.indexOf('AN') == 0) || (product_url.indexOf('GR') == 0) || (product_url.indexOf('HD') == 0) || (product_url.indexOf('KK') == 0) || (product_url.indexOf('KM') == 0) || (product_url.indexOf('PK') == 0) || (product_url.indexOf('PL') == 0) || (product_url.indexOf('SW') == 0) || (product_url.indexOf('TB') == 0) || (product_url.indexOf('LN') == 0) || (product_url.indexOf('ST') == 0) || (product_url.indexOf('ZD') == 0) || (product_url.indexOf('KX') == 0)) {
      source = "aptel";
      product_url = $('#input_add_product_modal').val();

    }
    else{
      source = get_hostname($('#input_add_product_modal').val());
      if (source == null){
        source = $('#input_add_product_modal').val().replace('http://','https://');
        source = get_hostname(source);

      }
      if (source.indexOf("shopee") >= 0){
            source = "shopee";
      }
      else if (source.indexOf("aliexpress") >= 0){
          source = "aliexpress";
      }   
      else{
          source = "other";
      }

    }



    if( $('#input_add_product_modal').val().length !== 0 ) {

             $.ajax({
                    url : 'get_product_data.php',
                    type : 'POST',
                    data : {url: product_url, datatype: "url", which_item: "unset"},
                    dataType : 'json',
                    success : function (result) {

                      $(".add_url").css("display", "none");
                      $('.after_url').css("display", "none");
                      $('.variables').empty();
                      $('.variables').css("display", "block");
                      var new_which_item = '';
                      var countVariables = '';

                      if (result['variants'] != null){
                       countVariables = result['variants'].length;


                      for (var i = 0; i < countVariables; i++) { 
                              var arrayInfo = []; 
                              var variablesDiv = document.createElement('div'); 
                              variablesDiv.id = 'variable_id' + i; 
                              variablesDiv.className = 'variable_div'; 
                              variablesDiv.style.width = "230px"; 
                              variablesDiv.style.height = "230px"; 

                              if (countVariables==2){
                                variablesDiv.style.width = "350px"; 
                                variablesDiv.style.height = "350px"; 
                              }
                              else if (countVariables==3){
                                variablesDiv.style.width = "230px"; 
                                variablesDiv.style.height = "230px"; 

                              }
                              else if (countVariables==4){
                                variablesDiv.style.width = "160px"; 
                                variablesDiv.style.height = "160px"; 

                              }
                              else if (countVariables==5){
                                variablesDiv.style.width = "230px"; 
                                variablesDiv.style.height = "230px"; 

                              }
                              else if (countVariables==6){
                                variablesDiv.style.width = "230px"; 
                                variablesDiv.style.height = "230px"; 

                              }
                              else{
                                variablesDiv.style.width = "230px"; 
                              variablesDiv.style.height = "230px"; 

                              }        
                              variablesDiv.style.display = "inline-block"; 
                              const parentElementVariables = document.querySelector('.variables');
                              parentElementVariables.appendChild(variablesDiv);

                              var variableImgId = "variableImg"+i;
                              var variableTitleId = "variableTitle"+i;
                              var which_item_data = result['variants'][i].propertyValueDisplayName;
                              variant = which_item_data;
                              $(variablesDiv).prepend('<img class="variable_img" id="'+variableImgId+'" src="'+result['variants'][i].skuPropertyImagePath+'" />');
                              $(variablesDiv).prepend('<div class="variable_title" id="'+variableTitleId+'" src="'+result['variants'][i].propertyValueDisplayName+'" />');
                              source_quantity = result['avaibleQuantity'];
                              $('#variableImg'+i).attr('propertyValueDisplayName', which_item_data);

                              $( ".variable_img").hover(
                                function() {
                                    $(this).css( "filter", "none" );
                                },
                                function() {
                                    $(this).css( "filter", "grayscale()" );      
                                }
                              );
                              $( ".variable_img").click(
                                function() {
                                    $(".variablesTitle").css("display", "block");
                                    $(".variablesModal").css("display", "block")
                                    $(".variable_img").removeClass("varFilter");
                                    $(".variable_img").css( "filter", "grayscale()" );
                                    $(this).addClass("varFilter");
                                    new_which_item = $(this).attr('propertyValueDisplayName'); 
                                          $.ajax({
                                              url : 'get_product_data.php',
                                              type : 'POST',
                                              data : {url: product_url, datatype: "url", which_item: new_which_item},
                                              dataType : 'json',
                                              success : function (result2) {
                                                 $(".variables").css("display", "none");
                                                 $('.variables').empty();

                                                  console.log(result['11']);
                                                  console.log(result['22']);
                                                  console.log(result['price']);

                                                  console.log(result['avaibleQuantity']);
                                                  console.log(result['ship_from']);
                                                  console.log(result['free_shippment']);

                                                    console.log(result['deliveryDayMax']);
                                                      console.log(result['guaranteedDeliveryTime']);
                                                         console.log(result['logisticsComposeDeliveryDate']);
                                                    console.log(result['scrap']);

                                                    variant = result2['variant'];
                                                   source_quantity = result2['avaibleQuantity'];
                                                 source_shippment_from = result2['ship_from'];
                                                 source_shippment_time = result2['deliveryDayMax'];
                                                 source_shippment_price = '0';
                                                    if (result2['ship_from'] == "Poland"){
                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                      $("#poland_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = 'pl';
                                                    }
                                                    else if (result2['ship_from'] == "China"){
                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                      $("#china_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = 'ch';
                                                    }
                                                    else if (result2['ship_from'] == "Germany"){
                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = 'de';
                                                    }
                                                    else if (result2['ship_from'] == "France"){
                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = 'fr';
                                                    }
                                                    else if (result2['ship_from'] == "Czech Republic"){
                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = 'cz';
                                                    }



                                                    $("#poland_ship").click(function(){
                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                      $("#poland_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = "pl";
                                                    });

                                                    $("#china_ship").click(function(){
                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                      $("#china_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = "ch";
                                                    });

                                                    $("#germany_ship").click(function(){
                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = "de";
                                                    });


                                                    $("#france_ship").click(function(){
                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = "fr";
                                                    });

                                                    $("#czech_ship").click(function(){
                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                      $("#czech_ship").addClass("hdxmeq_active");
                                                      source_shippment_from = "cz";
                                                    });
                                                  

                                                   $(".after_url").css("display", "flex");
                                                   //$("#product_img_modal").attr("src",result['image']);
                                                   $("#product_title_modal").text(result['title']);
                                                   $("#product_price_min_modal").text(result['price']);     
                                                   price_max = (result['price']*2) - (result['price']/3);
                                                   var product_price_max_decimal = parseFloat(price_max).toFixed(2);
                                                   $("#product_price_max_modal").text(product_price_max_decimal);     
                                                   price = result['price'];
                                                   var product_price_new = result['price'] * 1;
                                                   var product_price_pre = result['price'] * 0.45;
                                                   var product_price = product_price_new + product_price_pre;
                                                   product_price_decimal = parseFloat(product_price).toFixed(2);
                                                   $('.range-value').html('<span>'+product_price_decimal+'</span>');
                                            
                                                   $('.range-value').css({'left': (87/1.32)+'%'});
                                                   $('[type="range"]').attr('min', result2['price']);
                                                   $('[type="range"]').attr('max', price_max);
                                                   $('[type="range"]').attr('value', product_price_decimal);
                                                   $('[type="range"]').attr('step', "0.01");


                                              if (result2['free_shippment'] == "free"){
                                                  source_shippment_time = $("input[name='shippingTimeFilter']:checked").val();
                                                  $("#free_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                                   $("#free_shippment_span").addClass("radio_clicked");

                                                  }
                                                  else if (result2['source_shippment_time'] == "1-3"){
                                                         $(".shipping_time_choose").removeClass("radio_clicked");
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);  
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);  
                                                  $("#1_3_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 

                                                   $("#1_3_day_shippment_span").addClass("radio_clicked");
                                                  }
                                                  else if (result2['source_shippment_time'] == "4-7"){
                                                         $(".shipping_time_choose").removeClass("radio_clicked");
                                                 $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);  
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false); 
                                                       $("#4_7_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                                   $("#4_7_day_shippment_span").addClass("radio_clicked");

                                                  }
                                                  else if (result2['source_shippment_time'] == "8-11"){

                                                         $(".shipping_time_choose").removeClass("radio_clicked");
                                                 $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);  
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false); 
                                                 $("#8_11_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 

                                                   $("#8_11_day_shippment_span").addClass("radio_clicked");
                                                  }
                                                  else if (result2['source_shippment_time'] == "12-15"){
                                                         $(".shipping_time_choose").removeClass("radio_clicked");

                                                 $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);  
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false); 
                                                     $("#12_15_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 

                                                   $("#12_15_day_shippment_span").addClass("radio_clicked");
                                                  }
                                                  else if (result2['source_shippment_time'] == "16-25"){
                                                         $(".shipping_time_choose").removeClass("radio_clicked");
                                                 $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false); 
                                                     $("#16_25_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 

                                                   $("#16_25_day_shippment_span").addClass("radio_clicked");
                                                  }
                                                 else{
                                                         $(".shipping_time_choose").removeClass("radio_clicked");
                                                 $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);  
                                                     $("#25_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 


                                                   $("#25_day_shippment_span").addClass("radio_clicked");
                                                  }

                                                  source_shippment_time = $("input[name='shippingTimeFilter']:checked").val();

                                                  setTimeout(updateTooltip(), 500); 
                                                  doRest();
                                                  $('#add_product_button').css("display", "block");

                                              },
                                              error : function (e) {
                                                 alert("Wystapił błąd.");
                                              }
                                            });

                                          }

                                  );

                              }//end of for
                            $('.variablesModal').empty();

                              function doRest(){
                                        if (once == false){
                                        for (var i = 0; i < countVariables; i++) { 
                                          var arrayInfo = []; 
                                          var variablesDiv = document.createElement('div'); 
                                          variablesDiv.id = 'variable_id_small' + i; 
                                          variablesDiv.className = 'variable_div_small'; 
                                          variablesDiv.style.width = "60px"; 
                                          variablesDiv.style.height = "60px";         
                                          variablesDiv.style.display = "inline-block"; 
                                          const parentElementVariablesModal = document.querySelector('.variablesModal');
                                          parentElementVariablesModal.appendChild(variablesDiv);

                                          var variableImgId = "variableImg_small"+i;
                                          var which_item_data = result['variants'][i].propertyValueDisplayName;
                                          

                                          if (which_item_data == new_which_item){
                                              $(".variable_img_small").removeClass("varFilter");
                                             $(variablesDiv).prepend('<img class="variable_img_small varFilter" id="'+variableImgId+'" src="'+result['variants'][i].skuPropertyImagePath+'" />');
                                                                  $('#variableImg_small'+i).attr('propertyValueDisplayName', which_item_data);

                                             $("#product_img_modal").attr("src",result['variants'][i].skuPropertyImagePath);

                                          }
                                          else{
                                              $(variablesDiv).prepend('<img class="variable_img_small" id="'+variableImgId+'" src="'+result['variants'][i].skuPropertyImagePath+'" />');
                                              $('#variableImg_small'+i).attr('propertyValueDisplayName', which_item_data);
                                              }
                                      

                                                 $( ".variable_img_small").hover(
                                                          function() {
                                                              $(this).css( "filter", "none" );

                                                          },
                                                          function() {
                                                              $(this).css( "filter", "grayscale()" );      
                                                          }
                                                          );

                                                        $( ".variable_img_small").click(
                                                                       function() {
                                                    $(".variable_img_small").removeClass("varFilter");
                                                    $(".variablesTitle").css("display", "block");
                                                    $(".variablesModal").css("display", "block")
                                                    $(".variable_img").removeClass("varFilter");
                                                    $(".variable_img").css( "filter", "grayscale()" );
                                                        source_shippment_time = $("input[name='shippingTimeFilter']:checked").val();

                                                    $(this).addClass("varFilter");
                                                    new_which_item = $(this).attr('propertyValueDisplayName'); 
                                                          $.ajax({
                                                              url : 'get_product_data.php',
                                                              type : 'POST',
                                                              data : {url: product_url, datatype: "url", which_item: new_which_item},
                                                              dataType : 'json',
                                                              success : function (result2) {
                                                                 $(".variables").css("display", "none");
                                                                 $('.variables').empty();
                                                                 console.log(new_which_item);
                                                                  console.log(result['11']);
                                                                  console.log(result['22']);
                                                                  console.log(result['price']);

                                                                  console.log(result['avaibleQuantity']);
                                                                  console.log(result['ship_from']);
                                                                  console.log(result['free_shippment']);

                                                                  console.log(result['deliveryDayMax']);
                                                                  console.log(result['guaranteedDeliveryTime']);
                                                                  console.log(result['logisticsComposeDeliveryDate']);
                                                                  console.log(result['scrap']);



                                                                  variant = result2['variant'];
                                                                   source_quantity = result2['avaibleQuantity'];
                                                                   source_shippment_from = result2['ship_from'];
                                                                  source_shippment_time = result2['deliveryDayMax'];
                                                                 source_shippment_price = '0';
                                                                    if (result2['ship_from'] == "Poland"){
                                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                                      $("#poland_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = 'pl';
                                                                    }
                                                                    else if (result2['ship_from'] == "China"){
                                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                                      $("#china_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = 'ch';
                                                                    }
                                                                    else if (result2['ship_from'] == "Germany"){
                                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = 'de';
                                                                    }
                                                                    else if (result2['ship_from'] == "France"){
                                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = 'fr';
                                                                    }
                                                                    else if (result2['ship_from'] == "Czech Republic"){
                                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = 'cz';
                                                                    }



                                                                    $("#poland_ship").click(function(){
                                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                                      $("#poland_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = "pl";
                                                                    });

                                                                    $("#china_ship").click(function(){
                                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                                      $("#china_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = "ch";
                                                                    });

                                                                    $("#germany_ship").click(function(){
                                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = "de";
                                                                    });


                                                                    $("#france_ship").click(function(){
                                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = "fr";
                                                                    });

                                                                    $("#czech_ship").click(function(){
                                                                      $("#china_ship").removeClass("hdxmeq_active");
                                                                      $("#germany_ship").removeClass("hdxmeq_active");
                                                                      $("#france_ship").removeClass("hdxmeq_active");
                                                                      $("#poland_ship").removeClass("hdxmeq_active");
                                                                      $("#czech_ship").addClass("hdxmeq_active");
                                                                      source_shippment_from = "cz";
                                                                    });
                                                                   $(".after_url").css("display", "flex");
                                                                   $("#product_img_modal").attr("src",result2['variant_image']);
                                                                   $("#product_title_modal").text(result2['title']);
                                                                   $("#product_price_min_modal").text(result2['price']);     
                                                                   price_max = (result2['price']*2) - (result2['price']/3);
                                                                   var product_price_max_decimal = parseFloat(price_max).toFixed(2);
                                                                   $("#product_price_max_modal").text(product_price_max_decimal);     
                                                                   price = result2['price'];
                                                                   var product_price_new = result2['price'] * 1;
                                                                   var product_price_pre = result2['price'] * 0.45;
                                                                   var product_price = product_price_new + product_price_pre;
                                                                   product_price_decimal = parseFloat(product_price).toFixed(2);
                                                                   $('.range-value').html('<span>'+product_price_decimal+'</span>');
                                                            
                                                                   $('.range-value').css({'left': (87/1.32)+'%'});
                                                                   $('[type="range"]').attr('min', result2['price']);
                                                                   $('[type="range"]').attr('max', price_max);
                                                                   $('[type="range"]').attr('value', product_price_decimal);
                                                                   $('[type="range"]').attr('step', "0.01");


                                                                  if (result2['free_shippment'] == "free"){
 source_shippment_time = $("input[name='shippingTimeFilter']:checked").val();
                                                  $("#free_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                                   $("#free_shippment_span").addClass("radio_clicked");

                                                                  }

                                                                  if (result2['deliveryDayMax'] == "3"){
                                                                   $(".shipping_time_choose").removeClass("radio_clicked");
                                                   $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#1_3_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#1_3_day_shippment_span").addClass("radio_clicked");
                                                                  }
                                                                  else if (result2['deliveryDayMax'] == "5"){
                                                                   $(".shipping_time_choose").removeClass("radio_clicked");
                                                   $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#4_7_day_shippment_span").addClass("radio_clicked");
                                                                  }
                                                                  else if (result2['deliveryDayMax'] == "7"){
                                                                    $(".shipping_time_choose").removeClass("radio_clicked");
                                                   $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#4_7_day_shippment_span").addClass("radio_clicked");
                                                                  }
                                                                  else if (result2['deliveryDayMax'] == "10"){
                                                                    $(".shipping_time_choose").removeClass("radio_clicked");
                                                   $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#8_11_day_shippment_span").addClass("radio_clicked");
                                                                  }
                                                                  else if (result2['deliveryDayMax'] == "15"){
                                                                    $(".shipping_time_choose").removeClass("radio_clicked");
                                                   $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#16_25_day_shippment_span").addClass("radio_clicked");
                                                                  }
                                                                 else{
                                                                  

                                                                        $(".shipping_time_choose").removeClass("radio_clicked");
                                                 $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);  
                                                     $("#25_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 


                                                   $("#25_day_shippment_span").addClass("radio_clicked");
                                                                  }
                                                                  source_shippment_time = $("input[name='shippingTimeFilter']:checked").val();
                                                                  $('#add_product_button').css("display", "block");

                                                                  setTimeout(updateTooltip(), 500); 
                                                                  doRest();
                                                              },
                                                              error : function (e) {
                                                                 alert("Wystapił błąd.");
                                                              }
                                                            });

                                                          }
                                                          );
                                                      }
                                                      if (countVariables == i)
                                                      {
                                                        once = true;
                                                      }
                                                    }

                                                  }
                        }//end of if has variants
                        else{
                               console.log(result['11']);
                                            console.log(result['22']);
                                            console.log(result['price']);

                                            console.log(result['avaibleQuantity']);
                                            console.log(result['ship_from']);
                                            console.log(result['free_shippment']);

                                              console.log(result['deliveryDayMax']);
                                                console.log(result['guaranteedDeliveryTime']);
                                                   console.log(result['logisticsComposeDeliveryDate']);
                                              console.log(result['scrap']);



                                              variant = result['variant'];
                                             source_quantity = result['avaibleQuantity'];
                                             source_shippment_from = result['source_shippment_from'];
                                             source_shippment_time = result['source_shippment_time'];
                                           source_shippment_price = result['source_shippment_price'];

                                            suggested_title = result['suggested_title'];
                                            console.log(suggested_title);
                                            if (suggested_title != 0){
                                            $('#input_info_title_new').val(suggested_title);
                                            }

                                              if (result['ship_from'] == "Poland"){
                                                $("#china_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").removeClass("hdxmeq_active");
                                                $("#poland_ship").addClass("hdxmeq_active");
                                                source_shippment_from = 'pl';
                                              }
                                              else if (result['ship_from'] == "China"){
                                                $("#poland_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").removeClass("hdxmeq_active");
                                                $("#china_ship").addClass("hdxmeq_active");
                                                source_shippment_from = 'ch';
                                              }
                                              else if (result['ship_from'] == "Germany"){
                                                $("#china_ship").removeClass("hdxmeq_active");
                                                $("#poland_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").addClass("hdxmeq_active");
                                                source_shippment_from = 'de';
                                              }
                                              else if (result['ship_from'] == "France"){
                                                $("#china_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").removeClass("hdxmeq_active");
                                                $("#poland_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").addClass("hdxmeq_active");
                                                source_shippment_from = 'fr';
                                              }
                                              else if (result['ship_from'] == "Czech Republic"){
                                                $("#china_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").removeClass("hdxmeq_active");
                                                $("#poland_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").addClass("hdxmeq_active");
                                                source_shippment_from = 'cz';
                                              }



                                              $("#poland_ship").click(function(){
                                                $("#china_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").removeClass("hdxmeq_active");
                                                $("#poland_ship").addClass("hdxmeq_active");
                                                source_shippment_from = "pl";
                                              });

                                              $("#china_ship").click(function(){
                                                $("#poland_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").removeClass("hdxmeq_active");
                                                $("#china_ship").addClass("hdxmeq_active");
                                                source_shippment_from = "ch";
                                              });

                                              $("#germany_ship").click(function(){
                                                $("#china_ship").removeClass("hdxmeq_active");
                                                $("#poland_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").addClass("hdxmeq_active");
                                                source_shippment_from = "de";
                                              });


                                              $("#france_ship").click(function(){
                                                $("#china_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").removeClass("hdxmeq_active");
                                                $("#poland_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").addClass("hdxmeq_active");
                                                source_shippment_from = "fr";
                                              });

                                              $("#czech_ship").click(function(){
                                                $("#china_ship").removeClass("hdxmeq_active");
                                                $("#germany_ship").removeClass("hdxmeq_active");
                                                $("#france_ship").removeClass("hdxmeq_active");
                                                $("#poland_ship").removeClass("hdxmeq_active");
                                                $("#czech_ship").addClass("hdxmeq_active");
                                                source_shippment_from = "cz";
                                              });
                                             $(".variablesTitle").css("display", "none");
                                             $(".variable_img_small").removeClass("varFilter");
                                             $(".variablesModal").empty();
                                             $(".variablesModal").css("display", "none");
                                             $(".after_url").css("display", "flex");


                                               if (source == "aptel"){
                                                 source_price =  result['price'][0]; 
                                                 source_price = source_price.replace(',', '.');

                                                 $("#product_img_modal").attr("src",result['image'][0]);
                                                 var title_aptel = result['title'][0].replace(product_url, '');

                                                 $("#product_title_modal").text(title_aptel);


                                                 $("#china_ship").removeClass("hdxmeq_active");
                                                 $("#germany_ship").removeClass("hdxmeq_active");
                                                 $("#france_ship").removeClass("hdxmeq_active");
                                                 $("#czech_ship").removeClass("hdxmeq_active");
                                                 $("#poland_ship").addClass("hdxmeq_active");
                                                 source_shippment_from = "pl";

                                                    $(".shipping_time_choose").removeClass("radio_clicked");
                                                   $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#1_3_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#1_3_day_shippment_span").addClass("radio_clicked");
                                                  source_shippment_time = $("input[name='shippingTimeFilter']:checked").val();

                                                 $("#free_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                                 $("#free_shippment_span").addClass("radio_clicked");
                                              }
                                              else{
                                                source_price = result['source_price'];
                                                $("#product_img_modal").attr("src",result['image']);
                                                $("#product_title_modal").text(result['title']);
                                              
                                              }

                                                  if (result['price_from_server_aptel'] == "true"){
                                                       price = result['price'][0];
                                                       price = price.replace(',', '.');

                                                      $("#product_price_min_modal").text(price);     
                                                     price_max = (price*2) - (price/3);
                                                     var product_price_max_decimal = parseFloat(price_max).toFixed(2);
                                                     $("#product_price_max_modal").text(product_price_max_decimal);     
                                                     var product_price_new = price * 1;
                                                     var product_price_pre = price * 0.45;
                                                     var product_price = product_price_new + product_price_pre;
                                                     product_price_decimal = parseFloat(product_price).toFixed(2);
                                                     $('.range-value').html('<span>'+product_price_decimal+'</span>');
                                              
                                                     $('.range-value').css({'left': (87/1.32)+'%'});
                                                     $('[type="range"]').attr('min', price);
                                                     $('[type="range"]').attr('max', price_max);
                                                     $('[type="range"]').attr('value', product_price_decimal);
                                                     $('[type="range"]').attr('step', "0.01");
                                                  }
                                                  else{
                                                     $("#product_price_min_modal").text(result['price']);     
                                                     price_max = (result['price']*2) - (result['price']/3);
                                                     var product_price_max_decimal = parseFloat(price_max).toFixed(2);
                                                     $("#product_price_max_modal").text(product_price_max_decimal);     
                                                     price = result['price'];
                                                     var product_price_new = result['price'] * 1;
                                                     var product_price_pre = result['price'] * 0.45;
                                                     var product_price = product_price_new + product_price_pre;
                                                     product_price_decimal = parseFloat(product_price).toFixed(2);
                                                     $('.range-value').html(product_price_decimal+'<span></span>');
                                              
                                                     $('.range-value').css({'left': (87/1.32)+'%'});
                                                     $('[type="range"]').attr('min', result['price']);
                                                     $('[type="range"]').attr('max', price_max);
                                                     $('[type="range"]').attr('value', product_price_decimal);
                                                     $('[type="range"]').attr('step', "0.01");
                                                  }
                                             

                                            if (result['free_shippment'] == "free"){
                                             $("#free_shippment_span").css("background-color", "orange");

                                            }

                                            if (result['deliveryDayMax'] == "3"){
                                                 $(".shipping_time_choose").removeClass("radio_clicked");

                                             $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#1_3_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#1_3_day_shippment_span").addClass("radio_clicked");
                                            }
                                            else if (result['deliveryDayMax'] == "5"){
                                                                                                  $(".shipping_time_choose").removeClass("radio_clicked");

                                            $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#4_7_day_shippment_span").addClass("radio_clicked");
                                            }
                                            else if (result['deliveryDayMax'] == "7"){
                                                                                                  $(".shipping_time_choose").removeClass("radio_clicked");

                                            $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#8_11_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#8_11_day_shippment_span").addClass("radio_clicked");
                                            }
                                            else if (result['deliveryDayMax'] == "10"){
                                                                                                  $(".shipping_time_choose").removeClass("radio_clicked");

                                           $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#12_15_day_shippment_span").addClass("radio_clicked");
                                            }
                                            else if (result['deliveryDayMax'] == "15"){
                                                                                                  $(".shipping_time_choose").removeClass("radio_clicked");

                                              $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#16_25_day_shippment_span").addClass("radio_clicked");
                                            }
                                           else{
                                                                                                $(".shipping_time_choose").removeClass("radio_clicked");

                                             $("#1_3_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#4_7_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                    $("#8_11_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#12_15_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#16_25_day_shippment_span").parent().find('[type=radio]:checked').prop('checked', false);
                                                  $("#25_day_shippment_span").parent().find('[type=radio]').prop('checked', 'checked'); 
                                             $("#25_day_shippment_span").addClass("radio_clicked");
                                            }
    source_shippment_time = $("input[name='shippingTimeFilter']:checked").val();
                                            $('#add_product_button').css("display", "block");

                                            setTimeout(updateTooltip(), 500); 

                        }


                    },
                    error : function (e) {
                       alert("Wystapił błąd.");
                    }
                })    

    }


//$("#product_img_modal").html($("#everything").find('#MBYzB2').text());
   return false; // don't follow the link

});


var range = document.getElementById("month-price");
var range2 = document.getElementById("month-price-info");
var minusButton = document.querySelector(".control-minus");
var plusButton = document.querySelector(".control-plus");
var tooltip = document.querySelector(".range-value");
var minusButton2 = document.querySelector(".control-minus-info");
var plusButton2 = document.querySelector(".control-plus-info");
var tooltip2 = document.querySelector(".range-value-info");
var steps = 16, padding = 15;


// There's a small error due to pixel truncating in Chrome
var subpixelCorrection = 0.4;

// All browsers but IE
range.addEventListener("input", function(evt) {  
  updateTooltip ();
}, false);
// IE10
range.addEventListener("change", function(evt) {  
  updateTooltip ();
}, false);

// All browsers but IE
range2.addEventListener("input", function(evt) {  
  updateTooltip2();
}, false);
// IE10
range2.addEventListener("change", function(evt) {  
  updateTooltip2();
}, false);



function updateProducts(){
     $.ajax({
        type: 'POST',
        url: 'getData.php',
        data:'page=1',
        beforeSend: function () {
            $('.loading-overlay').show();
            $('#dataContainer').addClass("blur");
        },
        success: function (html) {
            $('#dataContainer').html(html);
            $('#dataContainer').removeClass("blur");
            $('.loading-overlay').fadeOut("slow");
        }
        });
}


function updateTooltip () {
const
  range = document.getElementById('month-price'),
  rangeV = document.getElementById('current-value'),
  setValue = ()=>{
    const
      newValue = Number( (range.value - range.min) * 100 / (range.max - range.min) ),
      newPosition = 10 - (newValue * 0.3);
    rangeV.innerHTML = `<span>${range.value}</span>`;
    rangeV.style.left = `calc(${newValue}% + (${newPosition}px))`;
  };
document.addEventListener("DOMContentLoaded", setValue);
range.addEventListener('input', setValue);


/*

  tooltip.firstElementChild.textContent = range.value;
  
  var startPosition = - (tooltip.clientWidth)/2 + padding + 4;
  var stepWidth = (range.getBoundingClientRect().width - padding*22)/steps - subpixelCorrection;  
  var currentStep =  range.value - range.min;


  // Reposition tooltip on top of the thumb
  tooltip.style.visibility = "visible";
  tooltip.style.left = Math.round(stepWidth*currentStep + startPosition) + "px";
 */   
}

minusButton.addEventListener("click", function() {
  range.stepDown();
  updateTooltip ();
}, false);

plusButton.addEventListener("click", function() {
  range.stepUp();
  updateTooltip ();
}, false);
function updateTooltip2() {
   $('#suggested_price').css({'display': 'none'});
   $('#suggested_price_zl').css({'display': 'none'});
 $('#current-value_info').css({'display': 'block'});
const
  range2 = document.getElementById('month-price-info'),
  rangeV2 = document.getElementById('current-value_info'),
  setValue2 = ()=>{
    const
      newValue2 = Number( (range2.value - range2.min) * 100 / (range2.max - range2.min) ),
      newPosition2 = 10 - (newValue2 * 0.3);
    rangeV2.innerHTML = `<span id="product_info_price_modal">${range2.value}</span>`;
    rangeV2.style.left = `calc(${newValue2}% + (${newPosition2}px))`;
  };
document.addEventListener("DOMContentLoaded", setValue2);
range2.addEventListener('input', setValue2);


/*

  tooltip.firstElementChild.textContent = range.value;
  
  var startPosition = - (tooltip.clientWidth)/2 + padding + 4;
  var stepWidth = (range.getBoundingClientRect().width - padding*22)/steps - subpixelCorrection;  
  var currentStep =  range.value - range.min;


  // Reposition tooltip on top of the thumb
  tooltip.style.visibility = "visible";
  tooltip.style.left = Math.round(stepWidth*currentStep + startPosition) + "px";
 */   
}

minusButton2.addEventListener("click", function() {
  range2.stepDown2();
  updateTooltip2 ();
}, false);

plusButton2.addEventListener("click", function() {
  range2.stepUp2();
  updateTooltip2 ();
}, false);

 $("#add_product_button").click(function(e) {
    var comments = '';
    var session_username = '<?php echo $_SESSION["username"]; ?>';
    if ($("#comments").val() == ""){
        comments = 'null'
    }
    else{
        comments = $("#comments").val();
    }
    source_shippment_time = $("input[name='shippingTimeFilter']:checked").val();


    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "add_product.php",
      data: {
        title: $('#product_title_modal').text(),
        comments: comments,
        price: $("#month-price").val(),
        new_title: $("#input_title_new").val(),
        source_price: $("#product_price_min_modal").text(),
        img: $("#product_img_modal").attr('src'),
        source: source,
        source_url: product_url,
        source_quantity: source_quantity,
        source_shippment_from: source_shippment_from,
        source_shippment_price: source_shippment_price,
        source_shippment_time: source_shippment_time,
        variant: variant,
        added_by: session_username
      },
      success: function(result) {
        $(".addProductModal").hide();
        $('#input_add_product_modal').val('');
        $(".after_url").hide();
        if (result == "Success"){
          alertify.confirm().set({ delay: 1700 });
          alertify.success("Dodano pomyślnie.");
        }
        else{
          alertify.confirm().set({ delay: 1700 });
          alertify.error("Wystapił błąd. Spróbuj ponownie.");
        }
          setTimeout(updateProducts(), 5000);

      },
      error: function(result) {
          $(".addProductModal").hide();
          $('#input_add_product_modal').val('');
          $(".after_url").hide();
          alertify.set({ delay: 1700 });
          alertify.error("Wystapił błąd");
          setTimeout(updateProducts(), 5000);

      }
    });
  });

</script>
</body>
</html>
<?php }}
} else {
    // Unset all of the session variables
    $_SESSION = [];

    // Destroy the session.
    session_destroy();
    if (headers_sent()) {
        die("Redirect failed. Please click on this link: <a href=...>");
    } else {
        exit(header("Location: login.php"));
    }
    // Redirect to login page
}
$conn->close();
?>


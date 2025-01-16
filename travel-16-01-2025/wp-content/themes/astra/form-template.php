<?php
/*
Template Name: Homee Template
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, proxy-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
</head>
   <style>

    #flightIframe {
        padding: 50px 0;
        min-height: 700px;
        display: none;
    }
       .date-picker-container {
           position: relative;
       }

       .calendar-popup {
           display: none;
           background-color: white;
           color: black;
           position: absolute;
           width: 580px;
           border: 1px solid #ddd;
           border-radius: 10px;
           box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
           z-index: 10;
           padding: 10px;
           display: none;
           justify-content: space-between;
           flex-direction: column;
       }

       .calendar-popup.above {
           bottom: 100%;
           margin-bottom: 10px;
       }

       .calendar-popup.below {
           top: 100%;
           margin-top: 10px;
       }

       .calendar-month {
           width: 50%;
           border: 1px solid #ddd;
           border-radius: 8px;
           padding: 10px;
           box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
       }

       .calendar-header {
           text-align: center;
           font-size: 18px;
           font-weight: bold;
           margin-bottom: 10px;
           position: relative;
       }

       .calendar-header .close-popup {
           position: absolute;
           top: 5px;
           right: 5px;
           font-size: 14px;
           cursor: pointer;
           color: #007bff;
       }

       .calendar-week-days,
       .calendar-days {
           display: grid;
           grid-template-columns: repeat(7, 1fr);
           gap: 5px;
           text-align: center;
       }

       .calendar-week-days div {
           font-weight: bold;
           color: #666;
       }

       .calendar-days button {
           padding: 6px;
           border: none;
           border-radius: 4px;
           background-color: #f4f4f4;
           cursor: pointer;
           color: black;
       }

       .calendar-days button:hover {
           background-color: #007bff;
           color: #fff;
       }

       .calendar-days button:disabled {
           background-color: #e9e9e9;
           color: #aaa;
           cursor: not-allowed;
       }

       .date-input {
           width: 100%;
           position: relative;

       }

       .date-input:focus+.calendar-popup {
           display: block;
       }
   </style>

   <style>
       .empty-circle:hover {
           box-shadow: 0 0 0px 7px rgba(0, 0, 0, 0.2);
       }

       .filled-circle:hover {
           box-shadow: 0 0 0px 6px #b9bdcf;
       }

       .parent {
           display: flex;
           flex-direction: column;
           align-items: center;
           justify-content: center;
       }

       .fields {
           display: grid;
       }

       .card {
           display: none;
           flex-direction: column;
           justify-content: center;
           gap: 1rem;
           border: 0;
           padding: 35px 32px 61px;
           border-radius: 30px;
           background-color: #e6e6e9 !important;
           width: 100%;
           position: relative;
       }



       .inp-field,
       .inp-field-date,
       .room {
           border: 0.5px solid black;
           border-radius: 0.25rem;
           /* padding: 7px 16px 5px 38px !important; */
           padding: 10px 5px;
           position: relative;
       }

       .inp-field-date:focus,
       .inp-field-ppl:focus,
       .room:focus {
           outline: none;
       }

       .inp-field-ppl {
           border: 0.5px solid black;
           border-radius: 0.25rem;
           /* padding: 0.75rem; */
           padding: 10px 5px;
           width: 90%;
           position: relative;

       }

       input,
       select,
       .placeholder_border {
           background-color: #e6e6e9 !important;
       }

       .inp-field-ppl::placeholder {
           color: #454a4e;
       }

       .placeholder {
           position: absolute;
           left: 2.3rem;
           top: 50%;
           transform: translateY(-50%);
           font-size: 1rem;
           color: black;
           pointer-events: none;
           transition: all 0.3s ease;
           font-weight: 500px;
       }

       /* .inp-field:focus+.placeholder,
       .inp-field-date:focus+.placeholder,
       .inp-field-date:not(:placeholder-shown)+.placeholder,
       .room:not(:placeholder-shown)+.placeholder,
       .room:focus+.placeholder {
           top: -0.1rem;
       } */

       .ppl-placeholder,
       .room-placeholder {
           position: absolute;
           top: -0.5rem;
           left: 1rem;
           background-color: rgba(255, 255, 255, 0.9);
           ;
           padding: 0 0.25rem;
       }

       #rt-ppl-placeholder,
       .room-placeholder {
           position: absolute;
           top: -0.8rem;
           left: 1rem;
           background-color: rgba(255, 255, 255, 0.9);
           ;
           padding: 0 0.25rem;
           width: 7rem;
           height: 1rem;
           font-size: 1rem;
           color: black;
       }



       .field-wrapper {
           display: flex;
           align-items: center;
           justify-content: center;
           position: relative;
           gap: 15px;
       }


       .field-wrapper>input,
       .field-wrapper>div {
           flex: 1;

       }

       .field-wrapper>input,
       .field-wrapper>select {
           padding-left: 40px;
           height: 48px;
       }

       .field-logo {
           display: flex;
           align-items: center;
           justify-content: center;
           position: absolute;
           top: 31%;
           left: 4%;
           z-index: 10;
       }

       .fa-plane {
           rotate: 270deg;
       }

       input:not(:placeholder-shown) {
            background-color: #e7f7ff;
            border-color: #007bff;
        }

       .inp-field:focus::placeholder {
           color: black;
       }

       /* Hide initial placeholder */
       .inp-field::placeholder {
           color: transparent;
           transition: color 0.3s ease;
       }

       .ow-ppl-modal,
       .rt-ppl-modal,
       .roomModal {
           background-color: #FFFFFF;
           padding: 1rem;
           border-radius: 0.5rem;
           display: none;
           position: absolute;
           top: 110%;
           left: 0%;
           flex-direction: column;
           justify-content: center;
           gap: 0.5rem;
           transition: all 0.2s ease;
           z-index: 10;
       }

       .cabin {
           display: flex;
           flex-direction: column;
           justify-content: center;
           gap: 0.5rem;
           margin: 0 0 1rem 0;
       }

       .cabin-title,
       .passengers-title,
       .room-title {
           font-size: 0.85rem;
           font-weight: 600;
       }

       .passengers,
       .room-ppl {
           display: flex;
           flex-direction: column;
           justify-content: center;
           gap: 0.85rem;
       }

       .pass-item,
       .room-item {
           display: grid;
           align-items: center;
           grid-template-columns: 29% 15% 15% 15%;
           justify-content: center;
           gap: 1rem;
           margin-left: 0.25rem;
       }

       .room-header {
           display: flex;
           align-items: center;
           justify-content: space-between;
           gap: 1rem;
           margin-left: 0.25rem;
       }

       .apply-btn {
           padding: 1.5rem 4rem;
           border-radius: 0.25rem;
           cursor: pointer;
           color: white;
           background-color: #07a9e2;
           text-align: center;
       }

       .cabin-select {
           padding: 0.5rem;
           cursor: pointer;
           border-radius: 0.5rem;
       }

       .cabin-select-modal {
           display: none;
           background-color: white;
           flex-direction: column;
           justify-content: center;
           position: absolute;
           top: 0;
           left: 0.5%;
           border-radius: 0.5rem;
           z-index: 10;
           transition: all 0.2s ease;
       }

       input,
       select {
           color: #475569;
       }

       .cabin-item {
           padding: 0.75rem;
       }

       .cabin-item:hover {
           background-color: #f5f5f5;
       }

       .container {
           width: 100%;
       }

       .ow-sec {
           display: none;
           align-items: center;
           justify-content: space-between;
           gap: 1rem;
           grid-template-columns: 24% 24% 24% 24%;
       }

       .rt-sec {
           display: grid;
           align-items: center;
           justify-content: space-between;
           gap: 0.75rem;
           grid-template-columns: 15% 15% 15% 15% 15% 15%
       }

       .hotel-fields {
           display: grid;
           align-items: center;
           justify-content: center;
           grid-template-columns: 40% 20% 20% 20%;
           gap: 1rem;
           margin: 1rem 0 0 0;
       }

       .car-feilds {
           display: flex;
           flex-direction: column;
           justify-content: center;
           gap: 1rem;
       }

       .first-row {
           display: grid;
           align-items: center;
           justify-content: center;
           grid-template-columns: 106%;
       }

       .second-row {
           display: grid;
           align-items: center;
           /* justify-content: center; */
           grid-template-columns: 38.5% 19% 19% 19%;
           gap: 1rem;
       }

       .third-row {
           display: grid;
           align-items: center;
           /* justify-content: center; */
           grid-template-columns: 46% 25.5% 25.5%;
           gap: 1rem;
       }


       .select {
           display: grid;
           grid-template-columns: 3% 75% 15%;
           gap: 1rem;
           padding: 1rem 1.5rem;
       }

       .select:hover {
           background-color: #F5F5F5;
           cursor: pointer;
       }

       /* For WebKit browsers (Chrome, Safari) */
       #dropdown::-webkit-scrollbar {
           width: 8px;
           /* Width of the scrollbar */
       }

       #dropdown::-webkit-scrollbar-thumb {
           background-color: rgb(0, 144, 224);
           /* Color of the scrollbar thumb */
           border-radius: 4px;
           /* Round corners of the thumb */
       }

       #dropdown::-webkit-scrollbar-track {
           background: rgba(255, 255, 255, 0.1);
           /* Background color of the track */
       }

       /* For Firefox */
       #dropdown {
           scrollbar-width: thin;
           /* Use thin scrollbar */
           border-radius: 1rem;
           scrollbar-color: rgb(0, 144, 224) rgba(255, 255, 255, 0.1);
           /* thumb color and track color */
       }


       .loc-name-pill {
           display: none;
           position: absolute;
           background-color: #C5C5C5;
           color: #595959;
           padding: 1px 25px;
           justify-content: center;
           align-items: center;
           gap: 0.5rem;
           font-size: 0.75rem;
           border-radius: 1rem;
           left: 30px;
           top: 20%;
           cursor: pointer;
       }

       #pillCar {

           left: 60px;

       }

       .loc-name-pill:hover {
           background-color: #C5C5C5;
       }

       .search-btn,
       .search-btnRT {
           background: linear-gradient(to bottom, #0090DF, #0068A2);

           color: white;
           display: flex;
           align-items: center;
           justify-content: center;
           gap: 1rem;
           font-weight: 500;
           padding: 0.7rem 4rem;
           border-radius: 2rem;
           position: absolute;
           top: 90%;
           left: 41%;
           cursor: pointer;
           border: 2px solid #008AD6;
       }

       .search-btnHotel {
           background: linear-gradient(to bottom, #0090DF, #0068A2);
           display: flex;
           align-items: center;
           justify-content: center;
           gap: 1rem;
           padding: 0.7rem 4rem;
           border-radius: 2rem;
           position: absolute;
           top: 82%;
           left: 41%;
           cursor: pointer;
           border: 2px solid #008AD6;
       }

       .search-btn:hover,
       .search-btnRT:hover,
       .search-btnHotel:hover {
           background: linear-gradient(to top, #0091E1, #006BA5);
       }

       .search-logo {
           color: white;
           font-size: 1.25rem;
       }

       .search {
        color: white;
       }

       .label-name {
           font-size: 16px;
           font-weight: 600;
       }

       .tabs {
           max-width: 400px;
           margin: 0 auto -25px;
           position: relative;
           z-index: 2;
           background: #fff;
           box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
           padding: 0 30px;
           border-radius: 20px;
           display: flex;
           justify-content: space-around;
           width: 90%;
           text-align: center;
       }

       input {
           padding: 10px 0px;
       }

       #discType,
       #discCompany {
           width: 100%
       }

       #retCarLogo,
       #checkoutCarLogo {
           left: 10%;
       }

       #locLogo {
           left: 4%;
       }

       #fromCar {
           width: 95%
       }

       .room-placeholder {
        font-weight: 600;
       }

       @media (max-width:1150px) {
           .rt-sec {
               grid-template-columns: 13% 13% 13% 13% 13% 12%;
           }
       }

       @media (max-width:1057px) {
           .rt-sec {
               grid-template-columns: 100%;
           }

           .search-btnRT,
           .search-btnHotel {
               top: 93%;
           }
       }

       @media (max-width:1000px) {

           .search-btn,
           .search-btnRT,
           .search-btnHotel {
               left: 37%
           }
       }

       @media (max-width:875px) {
           .hotel-fields {
               grid-template-columns: 100%;
           }

           .search-btnHotel {
               top: 90%
           }
       }

       @media (max-width:850px) {
           .card {
               width: 100%
           }

           .ow-sec,
           .rt-sec,
           .second-row,
           .third-row {
               grid-template-columns: 100%;
           }

           .inp-field-ppl {
               width: 93%;
           }

           .tabs {
               width: 70%
           }

           .search-btn {
               top: 90%;
               right: 50%;
               left: 0;
               transform: translateX(50%);
           }

           .search-btnRT,
           .search-btnHotel {
               left: 35%
           }

           #discType,
           #discCompany {
               width: 97%
           }

           #fromCar {
               width: 95%
           }

          
           #retCarLogo,
           #checkoutCarLogo {
               left: 3%;
           }

           #locLogo {
               left: 6%;
           }
       }

       @media (max-width:670px) {

           .search-btn,
           .search-btnRT,
           .search-btnHotel {
               right: 50%;
               left: 0;
               transform: translateX(50%);
           }
       }

   </style>

   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

   <body>

   <div class="main_search">

       <div class="parent">
           <div id="cabin-select-modal" class="cabin-select-modal">
               <div class="cabin-item" id="cabinItem"
                   onclick="selectCabinType('By Price(lowest)'); event.stopPropagation();">
                   By Price(lowest)
               </div>
               <div class="cabin-item" id="cabinItem" onclick="selectCabinType('First'); event.stopPropagation();">First
               </div>
               <div class="cabin-item" id="cabinItem" onclick="selectCabinType('Business'); event.stopPropagation();">
                   Business
               </div>
               <div class="cabin-item" id="cabinItem"
                   onclick="selectCabinType('Economy Premium & Economy'); event.stopPropagation();">
                   Economy Premium & Economy
               </div>
               <div class="cabin-item" id="cabinItem"
                   onclick="selectCabinType('Economy Premium'); event.stopPropagation();">
                   Economy Premium
               </div>
               <div class="cabin-item" id="cabinItemRT" onclick="selectCabinType('Economy'); event.stopPropagation();">
                   Economy
               </div>
           </div>

           <div class="container">
               <div class="searchForm">
                   <div class="tabs">
                       <a class="tab active" id="flight" style="
             display: flex;
             flex-direction: column;
             align-items: center;
             justify-content: center;
             text-decoration: none;
             border-radius: 5px 5px 0 0;
             font-size: 14px;
             background-color: #fff;
             transition: 0.3s all;
             cursor: pointer;
             font-weight: bold;
             border: 0 !important;
             width: auto !important;
             padding: 10px 0px 12px !important;
             position: relative;
             text-transform: capitalize;
             text-align: center;
             border-bottom: 2px solid transparent !important;
             gap: 0.5rem;
             color: #999999;
           " onclick="changeTabUI(this); openCard();">
                           <img src="https://localhost/travelagency/wp-content/uploads/2024/10/tab-icon-flight.png" alt="tab-icon-flight" width="32" height="32" class="" style="
               display: block;
               filter: brightness(50%) contrast(100%) grayscale(1);
               margin: 0 auto 9px;
               opacity: 0.6;
               max-width: 100%;
               height: auto;
             " id="flightLogo" />
                           <span class="tab-name" id="flightText" style="">flights</span>
                       </a>

                       <a class="tab" id="hotel" style="
             display: flex;
             flex-direction: column;
             align-items: center;
             justify-content: center;
             text-decoration: none;
             border-radius: 5px 5px 0 0;
             font-size: 14px;
             background-color: #fff;
             transition: 0.3s all;
             cursor: pointer;
             font-weight: bold;
             border: 0 !important;
             width: auto !important;
             padding: 10px 0px 12px !important;
             position: relative;
             text-transform: capitalize;
             text-align: center;
             border-bottom: 2px solid transparent !important;
             gap: 0.5rem;
             color: #999999;
           " onclick="changeTabUI(this); openCard();">
                           <img src="https://localhost/travelagency/wp-content/uploads/2024/10/tab-icon-hotel.png" alt="tab-icon-hotel" width="32" height="32" class="" style="
               display: block;
               filter: brightness(50%) contrast(100%) grayscale(1);
               margin: 0 auto 9px;
               opacity: 0.6;
               max-width: 100%;
               height: auto;
             " id="hotelLogo" />
                           <span class="tab-name" style="" id="hotelText">hotels</span>
                       </a>

                       <a class="tab" id="car" style="
             display: flex;
             flex-direction: column;
             align-items: center;
             justify-content: center;
             text-decoration: none;
             border-radius: 5px 5px 0 0;
             font-size: 14px;
             background-color: #fff;
             transition: 0.3s all;
             cursor: pointer;
             font-weight: bold;
             border: 0 !important;
             width: auto !important;
             padding: 10px 0px 12px !important;
             position: relative;
             text-transform: capitalize;
             text-align: center;
             border-bottom: 2px solid changeTabUI !important;
             gap: 0.5rem;
             color: #999999;
           " onclick="changeTabUI(this); openCard();">
                           <img src="https://localhost/travelagency/wp-content/uploads/2024/10/tab-icon-car.png" alt="tab-icon-car" id="carLogo" width="32" height="32" class="" style="
               display: block;
               filter: brightness(50%) contrast(100%) grayscale(1);
               margin: 0 auto 9px;
               opacity: 0.6;
               max-width: 100%;
               height: auto;
             " />
                           <span class="tab-name" id="carText" style="">cars</span>
                       </a>
                   </div>
               </div>
           </div>

           <div class="card" id="card" style="
       
     ">
               <div class="types">
                   <div class="radio-btns" style="display: flex; gap: 5px 10px; flex-wrap: wrap">
                       <div id="OW" class="OW" style="
             border: 1px solid #d5d5d5;
             border-radius: 50px;
             padding: 5px 20px 5px 10px;
             color: #666666;
             display: flex;
             align-items: center;
             font-weight: 400;
             font-family: Century Gothic, CenturyGothic;
             -webkit-tap-highlight-color: transparent;
             outline: 0;
             transition: all 0.3s ease;
           ">
                           <label class="btn" style="
               user-select: none;
               cursor: pointer;
               display: inline-flex;
               align-items: center;
               white-space: nowrap;
               vertical-align: middle;
               width: 100%;
               transition: all 0.3s ease;
             " onclick="oneWay(this)" id="owlbl">
                               <div class="logo-container" style="
                 box-sizing: border-box;
                 display: inline-block;
                 position: relative;
                 width: 20px;
                 height: 20px;
                 flex-shrink: 0;
               ">
                                   <i class="far fa-circle empty-circle"
                                       style="border-radius: 50%; transition: opacity 0.3s ease"></i>
                                   <i class="fas fa-circle filled-circle" style="
                   border-radius: 50%;
                   display: none;
                   transition: opacity 0.3s ease;
                 "></i>
                               </div>
                               <span class="label-name">One Way</span>
                           </label>
                       </div>
                       <div id="RT" class="RT" style="
             border: 1px solid #d5d5d5;
             border-radius: 50px;
             padding: 5px 20px 5px 10px;
             color: #666666;
             display: flex;
             align-items: center;
             font-weight: 400;
             font-family: Century Gothic, CenturyGothic;
             -webkit-tap-highlight-color: transparent;
             outline: 0;
             transition: all 0.3s ease;
           ">
                           <label class="btn" style="
               user-select: none;
               cursor: pointer;
               display: inline-flex;
               align-items: center;
               white-space: nowrap;
               vertical-align: middle;
               width: 100%;
               transition: all 0.3s ease;
             " onclick="RoundTrip(this)">
                               <div class="logo-container" style="
                 box-sizing: border-box;
                 display: inline-block;
                 position: relative;
                 width: 20px;
                 height: 20px;
                 flex-shrink: 0;
               ">
                                   <i class="far fa-circle empty-circle"
                                       style="border-radius: 50%; transition: opacity 0.3s ease"></i>
                                   <i class="fas fa-circle filled-circle" style="
                   border-radius: 50%;
                   display: none;
                   transition: opacity 0.3s ease;
                 "></i>
                               </div>
                               <span class="label-name">Round Trip</span>
                           </label>
                       </div>
                   </div>
               </div>

               <div class="ow-sec fields" id="owSec">
                   <div class="field-wrapper">
                       <div class="field-logo"><i class="fas fa-plane"></i></div>
                       <input style="padding-left: 30px;" class="inp-field date-input inp-field-date" type="text" id="fromFlightOW"
                           onfocus="changeBorderColorFocus(this)" onblur="changeBorderColorBlur(this)" />
                       <div class="placeholder placeholder_border">From</div>
                       <div class="loc-name-pill" id="pillFromOW">
                           <span id="locNameFromOW"></span>
                           <span id="locIdFromOW" style="display:none"></span>
                           <span id="locCountryFromOW" style="display:none"></span>
                           <i class="fas fa-times-circle" onclick="closePillFromOW()"></i>
                       </div>
                       <div class="dropdown" id="dropdownFlightFromOW" style="display: none; background-color: #FFFFFF;
                         width: 98%;
                         position: absolute;
                         top: 108%;
                         z-index: 11;
                         border-radius: 0.5rem; height:16rem; overflow: auto;">
                           <div id="resultsFlightFromOW"></div>
                       </div>
                       <div id="loaderFlightFromOW" style="display: none; position: absolute; right: 4%; top: 50%; transform: translateY(-50%); color: rgb(0, 144, 224);">
                           <i class="fas fa-circle-notch fa-spin"></i>
                       </div>


                   </div>
                   <div class="field-wrapper">
                       <div class="field-logo"><i class="fas fa-plane"></i></div>
                       <input style="padding-left: 30px;" class="inp-field date-input inp-field-date" type="text" id="toFlightOW" onfocus="changeBorderColorFocus(this)"
                           onblur="changeBorderColorBlur(this)" />
                       <div class="placeholder placeholder_border">To</div>
                       <div class="loc-name-pill" id="pillToOW">
                           <span id="locNameToOW"></span>
                           <span id="locIdToOW" style="display:none"></span>
                           <span id="locCountryToOW" style="display:none"></span>
                           <i class="fas fa-times-circle" onclick="closePillToOW()"></i>
                       </div>
                       <div class="dropdown" id="dropdownFlightToOW" style="display: none; background-color: #FFFFFF;
                         width: 98%;
                         position: absolute;
                         top: 108%;
                         z-index: 11;
                         border-radius: 0.5rem; height:16rem; overflow: auto;">
                           <div id="resultsFlightToOW"></div>
                       </div>
                       <div id="loaderFlightToOW" style="display: none; position: absolute; right: 4%; top: 50%; transform: translateY(-50%); color: rgb(0, 144, 224);">
                           <i class="fas fa-circle-notch fa-spin"></i>
                       </div>


                   </div>
                   <div class="field-wrapper">
                       <div class="field-logo"><i class="fas fa-calendar"></i></div>

                       <div class="date-picker-container">
                           <input style="padding-left:30px;" id="datepicker" class="date-input inp-field-date inp-field" placeholder=""
                               onblur="changeBorderColorBlur(this)" onclick="toggleCalendar(this)" />
                           <div class="placeholder placeholder_border">Depature Date</div>
                           <div class="calendar-popup">
                               <div class="calendar-header">
                                   <span>Choose Date</span>
                                   <span class="close-popup" onclick="toggleCalendar(this)">X</span>
                               </div>
                               <div class="calender-flex" style="display: flex;gap: 10px;">
                                   <div class="calendar-month" id="currentMonth"></div>
                                   <div class="calendar-month" id="nextMonth"></div>
                               </div>
                           </div>
                       </div>

                   </div>
                   <div class="field-wrapper">

                       <input style="padding-left: 30px;" class="inp-field-ppl" id="inputFieldPPLOW" type="text" placeholder="1 adults"
                           onclick="openPassengersModalOW()" />

                       <div class="ppl-placeholder placeholder_border" id="rt-ppl-placeholder" style="width:14rem !important;">Cabin Class & Passengers</div>
                       <div class="ow-ppl-modal" id="owPPLModal">
                           <div class="cabin">
                               <div class="cabin-title">Cabin</div>
                               <input type="text" id="cabinFieldOW" class="cabin-select"
                                   onclick="openCabinModalOW()" readonly />
                           </div>

                           <div class="passengers">
                               <div class="passengers-title">Passengers</div>
                               <div class="pass-item">
                                   <span>Adults:</span>
                                   <span id="minusAdultOW" style="
                         color: #dbdbdb;
                         font-weight: 600;
                         transition: all 0.3s ease;
                         pointer-events: none;
                         " onclick="incAdult(-1)">-1</span>
                                   <span id="adultOW" style="font-weight: 600">1</span>
                                   <span id="plusAdultOW" style="
                         color: #07a9e2;
                         font-weight: 600;
                         cursor: pointer;
                         transition: all 0.3s ease;
                         " onclick="incAdult(1)">+1</span>
                               </div>
                               <div class="pass-item">
                                   <span>Children:</span>
                                   <span id="minusChildrenOW" style="
                         color: #dbdbdb;
                         font-weight: 600;
                         transition: all 0.3s ease;
                         pointer-events: none;
                         " onclick="incChildren(-1)">-1</span>
                                   <span id="childrenOW" style="font-weight: 600">0</span>
                                   <span id="plusChildrenOW" style="
                         color: #07a9e2;
                         font-weight: 600;
                         cursor: pointer;
                         transition: all 0.3s ease;
                         " onclick="incChildren(1)">+1</span>
                               </div>
                               <div class="pass-item">
                                   <span>Infants:</span>
                                   <span id="minusInfantOW" style="
                         color: #dbdbdb;
                         font-weight: 600;
                         transition: all 0.3s ease;
                         pointer-events: none;
                         " onclick="incInfant(-1)">-1</span>
                                   <span id="infantOW" style="font-weight: 600">0</span>
                                   <span id="plusInfantOW" style="
                         color: #07a9e2;
                         font-weight: 600;
                         cursor: pointer;
                         transition: all 0.3s ease;
                         " onclick="incInfant(1)">+1</span>
                               </div>
                           </div>

                           <button onclick="document.body.click()" class="apply-btn">Apply</button>
                       </div>
                   </div>

                   <div class="search-btn" onclick="submitFlightOW();">
                       <div class="search-logo">
                           <i class="fas fa-search"></i>
                       </div>
                       <div class="search">SEARCH</div>
                   </div>
               </div>

               <div class="rt-sec" id="rtSec">
                   <div class="field-wrapper">
                       <div class="field-logo"><i class="fas fa-plane"></i></div>
                       <input style="padding-left: 30px;" class="inp-field date-input inp-field-date" type="text" id="fromFlightRT"
                           onfocus="changeBorderColorFocus(this)" onblur="changeBorderColorBlur(this)" />
                       <div class="placeholder placeholder_border">From</div>
                       <div class="loc-name-pill" id="pillFromRT">
                           <span id="locNameFromRT"></span>
                           <span id="locIdFromRT" style="display:none"></span>
                           <span id="locCountryFromRT" style="display:none"></span>
                           <i class="fas fa-times-circle" onclick="closePillFromRT()"></i>
                       </div>
                       <div class="dropdown" id="dropdownFlightFromRT" style="display: none; background-color: #FFFFFF;
                         width: 94%;
                         position: absolute;
                         top: 108%;
                         z-index: 11;
                         border-radius: 0.5rem; height:16rem; overflow: auto;">
                           <div id="resultsFlightFromRT"></div>
                       </div>
                       <div id="loaderFlightFromRT" style="display: none; position: absolute; right: 4%; top: 50%; transform: translateY(-50%); color: rgb(0, 144, 224);">
                           <i class="fas fa-circle-notch fa-spin"></i>
                       </div>

                   </div>
                   <div class="field-wrapper">
                       <div class="field-logo"><i class="fas fa-plane"></i></div>
                       <input style="padding-left: 30px;" class="inp-field date-input inp-field-date" type="text" id="toFlightRT" onfocus="changeBorderColorFocus(this)"
                           onblur="changeBorderColorBlur(this)" />
                       <div class="placeholder placeholder_border">To</div>

                       <div class="loc-name-pill" id="pillToRT">
                           <span id="locNameToRT"></span>
                           <span id="locIdToRT" style="display:none"></span>
                           <span id="locCountryToRT" style="display:none"></span>
                           <i class="fas fa-times-circle" onclick="closePillToRT()"></i>
                       </div>
                       <div class="dropdown" id="dropdownFlightToRT" style="display: none; background-color: #FFFFFF;
                         width: 94%;
                         position: absolute;
                         top: 108%;
                         z-index: 11;
                         border-radius: 0.5rem; height:16rem; overflow: auto;">
                           <div id="resultsFlightToRT"></div>
                       </div>
                       <div id="loaderFlightToRT" style="display: none; position: absolute; right: 4%; top: 50%; transform: translateY(-50%); color: rgb(0, 144, 224);">
                           <i class="fas fa-circle-notch fa-spin"></i>
                       </div>


                   </div>
                   <div class="field-wrapper">
                       <div class="field-logo"><i class="fas fa-calendar"></i></div>
                       <!-- <input class="inp-field" type="text" placeholder="Departure Date" /> -->
                       <!-- <input style="padding-left: 30px;" id="depDate" class="inp-field-date" type="date" placeholder=" " 
                         onblur="changeBorderColorBlur(this)" />
                     <div class="placeholder placeholder_border">Depature Date</div> -->

                       <div class="date-picker-container">
                           <input style="padding-left:30px;" id="depDateFRT" class="date-input inp-field-date inp-field" placeholder=""
                               onblur="changeBorderColorBlur(this)" onclick="toggleCalendar(this)" />
                           <div class="placeholder placeholder_border">Depature Date</div>
                           <div class="calendar-popup">
                               <div class="calendar-header">
                                   <span>Choose Date</span>
                                   <span class="close-popup" onclick="toggleCalendar(this)">X</span>
                               </div>
                               <div class="calender-flex" style="display: flex;gap: 10px;">
                                   <div class="calendar-month" id="currentMonth"></div>
                                   <div class="calendar-month" id="nextMonth"></div>
                               </div>
                           </div>
                       </div>


                   </div>

                   <div class="field-wrapper">
                       <div class="field-logo"><i class="fas fa-calendar"></i></div>

                       <div class="date-picker-container">
                           <input style="padding-left:30px;" id="retDateFRT" class="date-input inp-field-date inp-field" placeholder=""
                               onblur="changeBorderColorBlur(this)" onclick="toggleCalendar(this)" />
                           <div class="placeholder placeholder_border">Return Date</div>
                           <div class="calendar-popup">
                               <div class="calendar-header">
                                   <span>Choose Date</span>
                                   <span class="close-popup" onclick="toggleCalendar(this)">X</span>
                               </div>
                               <div class="calender-flex" style="display: flex;gap: 10px;">
                                   <div class="calendar-month" id="currentMonth"></div>
                                   <div class="calendar-month" id="nextMonth"></div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="field-wrapper">
                       <div class="field-logo" style="margin: 0 0 0 0.5rem;"><i class="far fa-clock"></i></div>
                       <!-- <input class="inp-field" type="text" placeholder=" "
                         onfocus="changeBorderColorFocus(this)" onblur="changeBorderColorBlur(this)" /> -->
                         <select class="inp-field date-input inp-field-date" id="returnTimeSelectFRT" style="padding-left: 33px;">
                            <option value="" disabled selected hidden></option> <!-- Placeholder option -->
                            <option value="null">Any time</option>
                            <option value="0000">12:00 am</option>
                            <option value="0100">1:00 am</option>
                            <option value="0200">2:00 am</option>
                            <option value="0300">3:00 am</option>
                            <option value="0400">4:00 am</option>
                            <option value="0500">5:00 am</option>
                            <option value="0600">6:00 am</option>
                            <option value="0700">7:00 am</option>
                            <option value="0800">8:00 am</option>
                            <option value="0900">9:00 am</option>
                            <option value="1000">10:00 am</option>
                            <option value="1100">11:00 am</option>
                            <option value="1200">12:00 pm</option>
                            <option value="1300">1:00 pm</option>
                            <option value="1400">2:00 pm</option>
                            <option value="1500">3:00 pm</option>
                            <option value="1600">4:00 pm</option>
                            <option value="1700">5:00 pm</option>
                            <option value="1800">6:00 pm</option>
                            <option value="1900">7:00 pm</option>
                            <option value="2000">8:00 pm</option>
                            <option value="2100">9:00 pm</option>
                            <option value="2200">10:00 pm</option>
                            <option value="2300">11:00 pm</option>
                        </select>

                       <div class="placeholder placeholder_border" style="top: none!;">Return Time</div>
                   </div>
                   <div class="field-wrapper">
                       <input class="inp-field-ppl" id="inputFieldPPLRT" style="width: 93%;padding-left: 30px;" type="text" placeholder="1 adults"
                           onclick="openPassengersModalRT()" />
                       <div class="ppl-placeholder placeholder_border" id="rt-ppl-placeholder">Cabin, Class...</div>
                       <div class="rt-ppl-modal" id="rtPPLModal">
                           <div class="cabin">
                               <div class="cabin-title">Cabin</div>
                               <input type="text" name="" id="cabinFieldRT" class="cabin-select"
                                   onclick="openCabinModalRT()" readonly />
                           </div>

                           <div class="passengers">
                               <div class="passengers-title">Passengers</div>
                               <div class="pass-item">
                                   <span>Adults:</span>
                                   <span id="minusAdultRT" style="
                         color: #dbdbdb;
                         font-weight: 600;
                         transition: all 0.3s ease;
                         pointer-events: none;
                         " onclick="incAdult(-1)">-1</span>
                                   <span id="adultRT" style="font-weight: 600">1</span>
                                   <span id="plusAdultRT" style="
                         color: #07a9e2;
                         font-weight: 600;
                         cursor: pointer;
                         transition: all 0.3s ease;
                         " onclick="incAdult(1)">+1</span>
                               </div>
                               <div class="pass-item">
                                   <span>Children:</span>
                                   <span id="minusChildrenRT" style="
                         color: #dbdbdb;
                         font-weight: 600;
                         transition: all 0.3s ease;
                         pointer-events: none;
                         " onclick="incChildren(-1)">-1</span>
                                   <span id="childrenRT" style="font-weight: 600">0</span>
                                   <span id="plusChildrenRT" style="
                         color: #07a9e2;
                         font-weight: 600;
                         cursor: pointer;
                         transition: all 0.3s ease;
                         " onclick="incChildren(1)">+1</span>
                               </div>
                               <div class="pass-item">
                                   <span>Infants:</span>
                                   <span id="minusInfantRT" style="
                         color: #dbdbdb;
                         font-weight: 600;
                         transition: all 0.3s ease;
                         pointer-events: none;
                         " onclick="incInfant(-1)">-1</span>
                                   <span id="infantRT" style="font-weight: 600">0</span>
                                   <span id="plusInfantRT" style="
                         color: #07a9e2;
                         font-weight: 600;
                         cursor: pointer;
                         transition: all 0.3s ease;
                         " onclick="incInfant(1)">+1</span>
                               </div>
                           </div>

                           <button onclick="document.body.click()" class="apply-btn">Apply</button>
                       </div>
                   </div>

                   <div class="search-btnRT" id="serchBtnRT" onclick="submitFlightRT()">
                       <div class="search-logo">
                           <i class="fas fa-search"></i>
                       </div>
                       <div class="search">SEARCH</div>
                   </div>
               </div>
           </div>

           <div class="card hotel-card" id="hotel-card">
               <div class="hotel-fields">
                   <div class="field-wrapper">
                       <div class="field-logo" style="left: 2%;"><i class="fas fa-plane"></i></div>
                       <input style="padding-left: 30px;" class="inp-field date-input inp-field-date" type="text" id="locHotel"
                           onfocus="changeBorderColorFocus(this)" onblur="changeBorderColorBlur(this)" />
                       <div class="placeholder placeholder_border">Location</div>
                       <div class="loc-name-pill" id="pillHotel">
                           <span id="locNameHotel"></span>
                           <span id="locIdHotel" style="display:none;"></span>
                           <span id="locCountryHotel" style='display:none;'></span>
                           <i class="fas fa-times-circle" onclick="closePillHotel()"></i>
                       </div>
                       <div class="dropdown" id="dropdownHotel" style="display: none; background-color: #FFFFFF;
                     width: 98%;
                     position: absolute;
                     top: 108%;
                     z-index: 11;
                     border-radius: 0.5rem; height:16rem; overflow: auto;">
                           <div id="resultsHotel"></div>
                       </div>
                       <div id="loaderHotel" style="display: none; position: absolute; right: 4%; top: 50%; transform: translateY(-50%); color: rgb(0, 144, 224);">
                           <i class="fas fa-circle-notch fa-spin"></i>
                       </div>


                   </div>
                   <div class="field-wrapper">
                       <div class="field-logo"><i class="fas fa-calendar"></i></div>
                       <!-- <input style="padding-left: 30px;" id="checkin" class="inp-field-date" type="date" placeholder=" " 
                     onblur="changeBorderColorBlur(this)" />
                 <div class="placeholder placeholder_border">Check In</div> -->


                       <div class="date-picker-container">
                           <input style="padding-left:30px;" id="checkin" class="date-input inp-field-date inp-field" placeholder=""
                               onblur="changeBorderColorBlur(this)" onclick="toggleCalendar(this)" />
                           <div class="placeholder placeholder_border">Check In</div>
                           <div class="calendar-popup">
                               <div class="calendar-header">
                                   <span>Choose Date</span>
                                   <span class="close-popup" onclick="toggleCalendar(this)">X</span>
                               </div>
                               <div class="calender-flex" style="display: flex;gap: 10px;">
                                   <div class="calendar-month" id="currentMonth"></div>
                                   <div class="calendar-month" id="nextMonth"></div>
                               </div>
                           </div>
                       </div>

                   </div>
                   <div class="field-wrapper">
                       <div class="field-logo"><i class="fas fa-calendar"></i></div>
                       <!-- <input style="padding-left: 30px;" id="checkout" class="inp-field-date" type="date" placeholder=" " 
                     onblur="changeBorderColorBlur(this)" />
                 <div class="placeholder placeholder_border">Check Out</div> -->


                       <div class="date-picker-container">
                           <input style="padding-left:30px;" id="checkout" class="date-input inp-field-date inp-field" placeholder=""
                               onblur="changeBorderColorBlur(this)" onclick="toggleCalendar(this)" />
                           <div class="placeholder placeholder_border">Check Out</div>
                           <div class="calendar-popup">
                               <div class="calendar-header">
                                   <span>Choose Date</span>
                                   <span class="close-popup" onclick="toggleCalendar(this)">X</span>
                               </div>
                               <div class="calender-flex" style="display: flex;gap: 10px;">
                                   <div class="calendar-month" id="currentMonth"></div>
                                   <div class="calendar-month" id="nextMonth"></div>
                               </div>
                           </div>
                       </div>

                   </div>
                   <div class="field-wrapper">
                       <input class="room" style="padding-left: 30px;" id="room" type="text" placeholder="Rooms:1, adults:1, children:0"
                           onclick="openRoomModal()" />
                       <div class="room-placeholder placeholder_border" id="room-placeholder" style="width: auto; top: -0.6rem;">Rooms</div>

                       <div class="roomModal" id="roomModal">
                           <div class="roomSec" id="roomSec1" style="margin: 0.5rem 0.25rem;">
                               <div class="room-header" style="margin: 0.5rem 0;">
                                   <div class="room-title">Room 1</div>
                                   <i class="fas fa-times" id="sec1-del" style="color: red; display: none;" onclick="removeRoom()"></i>
                               </div>

                               <div class="room-ppl">
                                   <div class="room-item">
                                       <span>Adults:</span>
                                       <span id="minusAdultRoom1" style="
                                     color: #6E7174;
                                     font-weight: 600;
                                     transition: all 0.3s ease;
                                     pointer-events: none;
                                     
                                     " onclick="incRoomAdult(1,-1)">-1</span>
                                       <span id="adultRoom1" style="font-weight: 600">1</span>
                                       <span id="plusAdultRoom1" style="
                                     color: #021529;
                                     font-weight: 600;
                                     cursor: pointer;
                                     transition: all 0.3s ease;
                                     
 
                                     " onclick="incRoomAdult(1,1)">+1</span>
                                   </div>
                                   <div class="room-item">
                                       <span>Children:</span>
                                       <span id="minusChildrenRoom1" style="
                                     color: #6E7174;
                                     font-weight: 600;
                                     transition: all 0.3s ease;
                                     pointer-events: none;
                                     margin-left: 3px;
 
                                     " onclick="incRoomChildren(1,-1)">-1</span>
                                       <span id="childrenRoom1" style="font-weight: 600">0</span>
                                       <span id="plusChildrenRoom1" style="
                                     color: #021529;
                                     font-weight: 600;
                                     cursor: pointer;
                                     transition: all 0.3s ease;
                                     margin-left: 3px;
                                     " onclick="incRoomChildren(1,1)">+1</span>
                                   </div>
                               </div>
                           </div>


                           <div class="room-btn" style=" font-size: 1rem; font-weight: 600; padding: 1em 0.5rem; cursor: pointer;" onclick="addRoom()">Add Room</div>
                       </div>
                   </div>
               </div>

               <div class="search-btnHotel" onclick="submitHotel()">
                   <div class="search-logo">
                       <i class="fas fa-search"></i>
                   </div>
                   <div class="search">SEARCH</div>
               </div>
           </div>

           <div class="card car-card" id="car-card">
               <div class="types">
                   <div class="radio-btns" style="display: flex; gap: 5px 10px; flex-wrap: wrap">
                       <div id="pickup" class="pickup" style="
                     border: 1px solid #d5d5d5;
                     border-radius: 50px;
                     padding: 5px 20px 5px 10px;
                     color: #666666;
                     display: flex;
                     align-items: center;
                     font-weight: 400;
                     font-family: Century Gothic, CenturyGothic;
                     -webkit-tap-highlight-color: transparent;
                     outline: 0;
                     transition: all 0.3s ease;
                 ">
                           <label class="btn" style="
                         user-select: none;
                         cursor: pointer;
                         display: inline-flex;
                         align-items: center;
                         white-space: nowrap;
                         vertical-align: middle;
                         width: 100%;
                         transition: all 0.3s ease;
                         " onclick="Pickup(this)" id="pickup-lbl">
                               <div class="logo-container" style="
                             box-sizing: border-box;
                             display: inline-block;
                             position: relative;
                             width: 20px;
                             height: 20px;
                             flex-shrink: 0;
                         ">
                                   <i class="far fa-circle empty-circle"
                                       style="border-radius: 50%; transition: opacity 0.3s ease"></i>
                                   <i class="fas fa-circle filled-circle" style="
                                 border-radius: 50%;
                                 display: inline;
                                 transition: opacity 0.3s ease;
                                 "></i>
                               </div>
                               <span class="label-name" style="font-size: 16px;">Same as Pickup</span>
                           </label>
                       </div>
                       <div id="DC" class="DC" style="
                     border: 1px solid #d5d5d5;
                     border-radius: 50px;
                     padding: 5px 20px 5px 10px;
                     color: #666666;
                     display: flex;
                     align-items: center;
                     font-weight: 400;
                     font-family: Century Gothic, CenturyGothic;
                     -webkit-tap-highlight-color: transparent;
                     outline: 0;
                     transition: all 0.3s ease;
                 ">
                           <label class="btn" style="
                         user-select: none;
                         cursor: pointer;
                         display: inline-flex;
                         align-items: center;
                         white-space: nowrap;
                         vertical-align: middle;
                         width: 100%;
                         transition: all 0.3s ease;
                         " onclick="DiscountCode(this)">
                               <div class="logo-container" style="
                             box-sizing: border-box;
                             display: inline-block;
                             position: relative;
                             width: 20px;
                             height: 20px;
                             flex-shrink: 0;
                         ">
                                   <i class="far fa-circle empty-circle"
                                       style="border-radius: 50%; transition: opacity 0.3s ease"></i>
                                   <i class="fas fa-check-circle" style="
                                    border-radius: 50%;
                                    display: none;
                                    transition: opacity 0.3s ease;
                                    "></i>

                               </div>
                               <span class="label-name placeholder_border" style="background-color: transparent !important;font-size: 16px;">Discount Code</span>

                           </label>

                       </div>


                   </div>
               </div>

               <div class="car-feilds" id="car-fields">
                   <div class="first-row">
                       <div class="field-wrapper" style="padding-left: 33px;padding-right: 33px;">
                           <div class="field-logo" id="locLogo"><i class="fas fa-map-marker-alt"></i></div>
                           <input style="padding-left:30px;" class="inp-field inp-field-date date-input" type="text" id='fromCar'
                               onfocus="changeBorderColorFocus(this)" onblur="changeBorderColorBlur(this)" />
                           <div class="placeholder placeholder_border" style="margin-left: 33px;">Location</div>
                           <div class="loc-name-pill" id="pillCar">
                               <span id="locNameCar"></span>
                               <span id="locIdCar" style="display: none;"></span>
                               <span id="locCountryCar" style="display: none;"></span>
                               <i class="fas fa-times-circle" onclick="closePillCar()"></i>
                           </div>
                           <div class="dropdown" id="dropdownCar" style="display: none; background-color: #FFFFFF;
                         width: 94%;
                         position: absolute;
                         top: 108%;
                         z-index: 11;
                         border-radius: 0.5rem; height:16rem; overflow: auto;">
                               <div id="resultsCar"></div>
                           </div>
                           <div id="loaderCar" style="display: none; position: absolute; right: 4%; top: 50%; transform: translateY(-50%); color: rgb(0, 144, 224);">
                               <i class="fas fa-circle-notch fa-spin"></i>
                           </div>

                       </div>
                   </div>
                   <div class="second-row">
                       <div class="field-wrapper forty">
                           <div class="field-logo"><i class="fas fa-calendar"></i></div>
                           <div class="date-picker-container">
                               <input style="padding-left:35px;" id="depDateCar" class="date-input inp-field-date inp-field"
                                   onblur="changeBorderColorBlur(this)" onclick="toggleCalendar(this)" />
                               <div class="placeholder placeholder_border">Depature Date</div>
                               <div class="calendar-popup">
                                   <div class="calendar-header">
                                       <span>Choose Date</span>
                                       <span class="close-popup" onclick="toggleCalendar(this)">X</span>
                                   </div>
                                   <div class="calender-flex" style="display: flex;gap: 10px;">
                                       <div class="calendar-month" id="currentMonth"></div>
                                       <div class="calendar-month" id="nextMonth"></div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="field-wrapper twenty">
                           <div class="field-logo" id="checkoutCarLogo"><i class="fas fa-calendar"></i></div>
                           <select class="date-input inp-field-date inp-field" id="checkoutCar" onblur="changeBorderColorBlur(this)">
                           <option value="" disabled selected hidden></option> <!-- Placeholder option -->
                           <option value="null">Any time</option> <!-- Hidden placeholder -->
                               <option value="0000">12:00 am</option>
                                <option value="0030">12:30 am</option>
                                <option value="0100">1:00 am</option>
                                <option value="0130">1:30 am</option>
                                <option value="0200">2:00 am</option>
                                <option value="0230">2:30 am</option>
                                <option value="0300">3:00 am</option>
                                <option value="0330">3:30 am</option>
                                <option value="0400">4:00 am</option>
                                <option value="0430">4:30 am</option>
                                <option value="0500">5:00 am</option>
                                <option value="0530">5:30 am</option>
                                <option value="0600">6:00 am</option>
                                <option value="0630">6:30 am</option>
                                <option value="0700">7:00 am</option>
                                <option value="0730">7:30 am</option>
                                <option value="0800">8:00 am</option>
                                <option value="0830">8:30 am</option>
                                <option value="0900">9:00 am</option>
                                <option value="0930">9:30 am</option>
                                <option value="1000">10:00 am</option>
                                <option value="1030">10:30 am</option>
                                <option value="1100">11:00 am</option>
                                <option value="1130">11:30 am</option>
                                <option value="1200">12:00 pm</option>
                                <option value="1230">12:30 pm</option>
                                <option value="1300">1:00 pm</option>
                                <option value="1330">1:30 pm</option>
                                <option value="1400">2:00 pm</option>
                                <option value="1430">2:30 pm</option>
                                <option value="1500">3:00 pm</option>
                                <option value="1530">3:30 pm</option>
                                <option value="1600">4:00 pm</option>
                                <option value="1630">4:30 pm</option>
                                <option value="1700">5:00 pm</option>
                                <option value="1730">5:30 pm</option>
                                <option value="1800">6:00 pm</option>
                                <option value="1830">6:30 pm</option>
                                <option value="1900">7:00 pm</option>
                                <option value="1930">7:30 pm</option>
                                <option value="2000">8:00 pm</option>
                                <option value="2030">8:30 pm</option>
                                <option value="2100">9:00 pm</option>
                                <option value="2130">9:30 pm</option>
                                <option value="2200">10:00 pm</option>
                                <option value="2230">10:30 pm</option>
                                <option value="2300">11:00 pm</option>
                                <option value="2330">11:30 pm</option>
                           </select>
                           <div class="placeholder placeholder_border">Depature Time</div>
                       </div>
                       <div class="field-wrapper twenty">
                           <div class="field-logo"><i class="fas fa-calendar"></i></div>

                           <div class="date-picker-container">
                               <input style="padding-left:30px;" id="retDateCar" class="date-input inp-field-date inp-field" placeholder=""
                                   onblur="changeBorderColorBlur(this)" onclick="toggleCalendar(this)" />
                               <div class="placeholder placeholder_border">Return Date</div>
                               <div class="calendar-popup">
                                   <div class="calendar-header">
                                       <span>Choose Date</span>
                                       <span class="close-popup" onclick="toggleCalendar(this)">X</span>
                                   </div>
                                   <div class="calender-flex" style="display: flex;gap: 10px;">
                                       <div class="calendar-month" id="currentMonth"></div>
                                       <div class="calendar-month" id="nextMonth"></div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="field-wrapper twenty">
                           <div class="field-logo" id='retCarLogo'><i class="fas fa-calendar"></i></div>
                           <select class="date-input inp-field-date inp-field" id="retTimeCar" style="width:99%;" onfocus="changeBorderColorFocus(this)" onblur="changeBorderColorBlur(this)">
                           <option value="" disabled selected hidden></option> <!-- Placeholder option -->    
                           <option value="null">Any time</option> <!-- Hidden placeholder -->
                               <option value="0000">12:00 am</option>
                                <option value="0030">12:30 am</option>
                                <option value="0100">1:00 am</option>
                                <option value="0130">1:30 am</option>
                                <option value="0200">2:00 am</option>
                                <option value="0230">2:30 am</option>
                                <option value="0300">3:00 am</option>
                                <option value="0330">3:30 am</option>
                                <option value="0400">4:00 am</option>
                                <option value="0430">4:30 am</option>
                                <option value="0500">5:00 am</option>
                                <option value="0530">5:30 am</option>
                                <option value="0600">6:00 am</option>
                                <option value="0630">6:30 am</option>
                                <option value="0700">7:00 am</option>
                                <option value="0730">7:30 am</option>
                                <option value="0800">8:00 am</option>
                                <option value="0830">8:30 am</option>
                                <option value="0900">9:00 am</option>
                                <option value="0930">9:30 am</option>
                                <option value="1000">10:00 am</option>
                                <option value="1030">10:30 am</option>
                                <option value="1100">11:00 am</option>
                                <option value="1130">11:30 am</option>
                                <option value="1200">12:00 pm</option>
                                <option value="1230">12:30 pm</option>
                                <option value="1300">1:00 pm</option>
                                <option value="1330">1:30 pm</option>
                                <option value="1400">2:00 pm</option>
                                <option value="1430">2:30 pm</option>
                                <option value="1500">3:00 pm</option>
                                <option value="1530">3:30 pm</option>
                                <option value="1600">4:00 pm</option>
                                <option value="1630">4:30 pm</option>
                                <option value="1700">5:00 pm</option>
                                <option value="1730">5:30 pm</option>
                                <option value="1800">6:00 pm</option>
                                <option value="1830">6:30 pm</option>
                                <option value="1900">7:00 pm</option>
                                <option value="1930">7:30 pm</option>
                                <option value="2000">8:00 pm</option>
                                <option value="2030">8:30 pm</option>
                                <option value="2100">9:00 pm</option>
                                <option value="2130">9:30 pm</option>
                                <option value="2200">10:00 pm</option>
                                <option value="2230">10:30 pm</option>
                                <option value="2300">11:00 pm</option>
                                <option value="2330">11:30 pm</option>
                           </select>
                           <div class="placeholder placeholder_border">Return Time</div>
                       </div>
                   </div>
                   <div class="third-row" id="thirdRow" style="display: none; margin: 0.5rem 0 0 0;">
                       <div class="field-wrapper forty">
                           <select class="inp-field inp-field-date date-input" id="discType" onfocus="changeBorderColorFocus(this)" onblur="changeBorderColorBlur(this)">
                           <option value="" disabled selected hidden></option>  
                           <option value="Corporate">Corporate</option>
                           <option value="professional">Professional</option>
                           </select>
                           <div class="placeholder placeholder_border">Disocunt Type</div>
                           </select>
                       </div>
                       <div class="field-wrapper thirty">
                           <select class="inp-field inp-field-date date-input" id="discCompany" onfocus="changeBorderColorFocus(this)" onblur="changeBorderColorBlur(this)">
                           <option value="" disabled selected hidden></option>
                           <option value="Hertz">Hertz</option>
                           </select>
                           <div class="placeholder placeholder_border">Discount Company</div>
                       </div>
                       <div class="field-wrapper thirty">
                           <input id="discCode" class="inp-field-date inp-field date-input" type="text"
                               onfocus="changeBorderColorFocus(this)" onblur="changeBorderColorBlur(this)" />
                           <div class="placeholder placeholder_border" style="left: 1rem;">Discount Code</div>
                       </div>
                   </div>
               </div>

               <div class="search-btn" id="searchBtnCar" onclick="submitCar()">
                   <div class="search-logo">
                       <i class="fas fa-search"></i>
                   </div>
                   <div class="search">SEARCH</div>
               </div>
           </div>


       </div>


   </div>

   <?php include locate_template('iframe-template.php'); ?>

   <script>
       function toggleCalendar(element) {
           const inputField = element;
           const calendarPopup = inputField.closest('.date-picker-container').querySelector('.calendar-popup');
           const isVisible = calendarPopup.style.display === 'block';
           calendarPopup.style.display = isVisible ? 'none' : 'block';

           if (!isVisible) {
               positionCalendar(calendarPopup);
               renderCalendar(calendarPopup);
           }
       }

       function positionCalendar(calendarPopup) {
           const inputRect = calendarPopup.previousElementSibling.getBoundingClientRect();
           const calendarRect = calendarPopup.getBoundingClientRect();
           const windowHeight = window.innerHeight;

           if (inputRect.top + calendarRect.height > windowHeight) {
               calendarPopup.classList.add('above');
               calendarPopup.classList.remove('below');
           } else {
               calendarPopup.classList.add('below');
               calendarPopup.classList.remove('above');
           }
       }

       function renderCalendar(calendarPopup) {
           const currentDate = new Date();
           const nextMonthDate = new Date(
               currentDate.getFullYear(),
               currentDate.getMonth() + 1,
               1
           );

           const currentMonthContainer = calendarPopup.querySelector('#currentMonth');
           const nextMonthContainer = calendarPopup.querySelector('#nextMonth');

           renderMonth(currentDate, currentMonthContainer);
           renderMonth(nextMonthDate, nextMonthContainer);
       }

       function renderMonth(date, container) {
           const monthName = date.toLocaleString('default', {
               month: 'long'
           });
           const year = date.getFullYear();
           const firstDay = new Date(year, date.getMonth(), 1).getDay();
           const daysInMonth = new Date(year, date.getMonth() + 1, 0).getDate();

           let daysHTML = '';
           for (let i = 0; i < firstDay; i++) {
               daysHTML += '<button disabled></button>';
           }
           for (let day = 1; day <= daysInMonth; day++) {
               daysHTML += `<button onclick="selectDate('${date.getMonth() +
  1}/${day}/${year}', this)">${day}</button>`;
           }

           container.innerHTML = `
<div class="calendar-header">${monthName} ${year}</div>
<div class="calendar-week-days">
  <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
</div>
<div class="calendar-days">${daysHTML}</div>
`;
       }

       function selectDate(date, buttonElement) {
           const inputField = buttonElement.closest('.date-picker-container').querySelector('.date-input');
           inputField.value = date;
           toggleCalendar(inputField);
       }

       document.addEventListener('click', (event) => {
           const calendarPopups = document.querySelectorAll('.calendar-popup');
           calendarPopups.forEach(popup => {
               if (
                   !event.target.closest('.calendar-popup') &&
                   !event.target.closest('.date-input')
               ) {
                   popup.style.display = 'none';
               }
           });
       });
   </script>


   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   <script>
       let selectedButton = null;
       let adults = 1;
       let children = 0;
       let infant = 0;
       let cabinType = ""
       let cabinField = ''
       let adultRoom = 1
       let childRoom = 0
       let room = 1
       let discount = false

       const cabinModal = document.getElementById("cabin-select-modal");
       const owlbl = document.getElementById("owlbl");
       const pickup = document.getElementById("pickup-lbl");

       oneWay(owlbl);
       const flight = document.getElementById('flight')
       flight.click()
       pickup.click()


       function changeBorderColorBlur(el) {
           console.log(el)
           el.style.border = '1px solid #ED9490'
       }

       function changeBorderColorFocus(el) {
           if (el.style.border === '1px solid rgb(237, 148, 144)') {
               // Leave it as-is if the color matches '#ED9490'
               return;
           } else {
               // Otherwise, apply the focus border color
               el.style.border = '1px solid #74C7E5';
               el.style.outline = 'none';
           }
       }

       function openPassengersModalOW() {
           console.log('cabin')
           const modal = document.getElementById("owPPLModal");
           modal.style.display = "flex";

           document.addEventListener("click", function closeModal(event) {
               // Check if the click was outside the modal and the button that opened it
               if (
                   !modal.contains(event.target) &&
                   event.target.id !== "inputFieldPPLOW"
               ) {
                   modal.style.display = "none"; // Hide the modal
                   document.removeEventListener("click", closeModal); // Remove the listener
               }
           });
       }

       function openPassengersModalRT() {
           const modal = document.getElementById("rtPPLModal");
           modal.style.display = "flex";

           document.addEventListener("click", function closeModal(event) {
               // Check if the click was outside the modal and the button that opened it
               if (
                   !modal.contains(event.target) &&
                   event.target.id !== "inputFieldPPLRT"
               ) {
                   modal.style.display = "none"; // Hide the modal
                   document.removeEventListener("click", closeModal); // Remove the listener
               }
           });
       }

       window.onclick = function(event) {
           if (event.target === cabinModal) {
               openCabinModalOW();
               openCabinModalRT();
           }
       };

       function openCabinModalOW() {
           const clickedElementId = event.target.id;
           console.log(clickedElementId)
           cabinField = clickedElementId

           const modal = document.getElementById("cabin-select-modal");
           if (modal.style.display === "flex") {
               modal.style.display = "none"; // Hide the modal
           } else {
               modal.style.display = "flex";
               modal.style.zIndex = '20'

               document.addEventListener("click", function closeModal(event) {
                   // Check if the click was outside the modal and the button that opened it
                   if (
                       !modal.contains(event.target) &&
                       event.target.id !== "cabinFieldOW" &&
                       !event.target.classList.contains("cabin-item")
                   ) {
                       modal.style.display = "none"; // Hide the modal
                       document.removeEventListener("click", closeModal); // Remove the listener
                   }
               });
           }
       }

       function openCabinModalRT() {
           const clickedElementId = event.target.id;
           console.log(clickedElementId)
           cabinField = clickedElementId

           const modal = document.getElementById("cabin-select-modal");
           if (modal.style.display === "flex") {
               modal.style.display = "none"; // Hide the modal
           } else {
               modal.style.display = "flex";
               modal.style.zIndex = '20'

               document.addEventListener("click", function closeModal(event) {
                   // Check if the click was outside the modal and the button that opened it
                   if (
                       !modal.contains(event.target) &&
                       event.target.id !== "cabinFieldRT" &&
                       !event.target.classList.contains("cabin-item")
                   ) {
                       modal.style.display = "none"; // Hide the modal
                       document.removeEventListener("click", closeModal); // Remove the listener
                   }
               });
           }
       }

       function openRoomModal() {
           const modal = document.getElementById("roomModal");
           modal.style.display = "flex";

           // Prevent clicks inside the modal from closing it
           modal.addEventListener("click", (event) => {
               event.stopPropagation();
           });

           // Event listener to close the modal when clicking outside of it
           function closeModal(event) {
               if (!modal.contains(event.target) && event.target.id !== "room") {
                   modal.style.display = "none";
                   document.removeEventListener("click", closeModal); // Remove the listener once the modal is closed
               }
           }

           // Only add the click event listener to the document if it's not already present
           setTimeout(() => document.addEventListener("click", closeModal), 0);
       }

       function selectCabinType(type) {
           cabinType = type;
           let inputField;


           if (cabinField === 'cabinFieldOW') {
               inputField = document.getElementById("inputFieldPPLOW");
           } else if (cabinField === 'cabinFieldRT') {
               inputField = document.getElementById("inputFieldPPLRT");
           }


           if ((children != 0 || infant != 0) && cabinType == "") {
               if (children != 0 && infant != 0)
                   inputField.placeholder = `${adults} adults, ${children} children, ${infant} infants`;
               else if (children != 0 && infant == 0)
                   inputField.placeholder = `${adults} adults, ${children} children`;
               else if (children == 0 && infant != 0)
                   inputField.placeholder = `${adults} adults, ${infant} infants`;
           }
           if ((children != 0 || infant != 0) && cabinType != "") {
               if (children != 0 && infant != 0)
                   inputField.placeholder = `${adults} adults, ${children} children, ${infant} infants, ${cabinType}`;
               else if (children != 0 && infant == 0)
                   inputField.placeholder = `${adults} adults, ${children} children, ${cabinType}`;
               else if (children == 0 && infant != 0)
                   inputField.placeholder = `${adults} adults, ${infant} infants, ${cabinType}`;
           }
           if (children == 0 && infant == 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults`;
           }
           if (children == 0 && infant == 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${cabinType}`;
           }
       }

       function incAdult(numb) {
           const clickedElementId = event.target.id;
           let inputField, minus, plus;

           adults += numb;

           if (clickedElementId === 'plusAdultOW' || clickedElementId === 'minusAdultOW') {
               document.getElementById("adultOW").textContent = adults;
               inputField = document.getElementById("inputFieldPPLOW");
               minus = document.getElementById("minusAdultOW");
               plus = document.getElementById("plusAdultOW");
               console.log(minus, plus)
           } else if (clickedElementId === 'plusAdultRT' || clickedElementId === 'minusAdultRT') {
               document.getElementById("adultRT").textContent = adults;
               inputField = document.getElementById("inputFieldPPLRT");
               minus = document.getElementById("minusAdultRT");
               plus = document.getElementById("plusAdultRT");
               console.log(minus, plus)
           }

           if (!minus || !plus) {
               console.warn("One of the elements (minus or plus) is undefined. Please check the element IDs.");
           }

           minus.style.cursor = "pointer";
           minus.style.color = "#07A9E2";
           minus.style.pointerEvents = "auto";

           if (adults == 1) {
               minus.style.pointerEvents = "none";
               minus.style.color = "#dbdbdb";
               minus.style.cursor = "auto";

               plus.style.pointerEvents = "auto";
               plus.style.color = "#07A9E2";
               plus.style.cursor = "pointer";
           } else if (adults == 3) {
               plus.style.pointerEvents = "none";
               plus.style.color = "#dbdbdb";
               plus.style.cursor = "auto";
           } else {
               minus.style.color = "#07A9E2";
               minus.style.pointerEvents = "auto";
               minus.style.cursor = "pointer";
           }

           if ((children != 0 || infant != 0) && cabinType == "") {
               if (children != 0 && infant != 0)
                   inputField.placeholder = `${adults} adults, ${children} children, ${infant} infants`;
               else if (children != 0 && infant == 0)
                   inputField.placeholder = `${adults} adults, ${children} children`;
               else if (children == 0 && infant != 0)
                   inputField.placeholder = `${adults} adults, ${infant} infants`;
           }
           if ((children != 0 || infant != 0) && cabinType != "") {
               if (children != 0 && infant != 0)
                   inputField.placeholder = `${adults} adults, ${children} children, ${infant} infants, ${cabinType}`;
               else if (children != 0 && infant == 0)
                   inputField.placeholder = `${adults} adults, ${children} children, ${cabinType}`;
               else if (children == 0 && infant != 0)
                   inputField.placeholder = `${adults} adults, ${infant} infants, ${cabinType}`;
           }
           if (children == 0 && infant == 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults`;
           }
           if (children == 0 && infant == 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${cabinType}`;
           }
       }

       function incChildren(numb) {
           const clickedElementId = event.target.id;
           console.log(clickedElementId)
           let inputField, minus, plus;

           children += numb;

           if (clickedElementId === 'plusChildrenOW' || clickedElementId === 'minusChildrenOW') {
               document.getElementById("childrenOW").textContent = children;
               inputField = document.getElementById("inputFieldPPLOW");
               minus = document.getElementById("minusChildrenOW");
               plus = document.getElementById("plusChildrenOW");
           } else if (clickedElementId === 'plusChildrenRT' || clickedElementId === 'minusChildrenRT') {
               document.getElementById("childrenRT").textContent = children;
               inputField = document.getElementById("inputFieldPPLRT");
               minus = document.getElementById("minusChildrenRT");
               plus = document.getElementById("plusChildrenRT");
           }

           if (!minus || !plus) {
               console.warn("One of the elements (minus or plus) is undefined. Please check the element IDs.");
           }

           minus.style.cursor = "pointer";
           minus.style.color = "#07A9E2";
           minus.style.pointerEvents = "auto";

           if (children == 0) {
               minus.style.pointerEvents = "none";
               minus.style.color = "#dbdbdb";
               minus.style.cursor = "auto";

               plus.style.pointerEvents = "auto";
               plus.style.color = "#07A9E2";
               plus.style.cursor = "pointer";
           } else if (children == 6) {
               plus.style.pointerEvents = "none";
               plus.style.color = "#dbdbdb";
               plus.style.cursor = "auto";
           } else {
               minus.style.color = "#07A9E2";
               minus.style.pointerEvents = "auto";
               minus.style.cursor = "pointer";
           }

           if (infant == 0 && children == 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults`;
           }
           if (infant == 0 && children != 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults, ${children} children`;
           }
           if (infant != 0 && children != 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults, ${children} children, ${infant} infant`;
           }
           if (infant != 0 && children == 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults, ${infant} infant`;
           }

           if (infant == 0 && children == 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${cabinType} cabinType`;
           }
           if (infant == 0 && children != 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${children} children, ${cabinType}`;
           }
           if (infant != 0 && children != 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${children} children, ${infant} infant, ${cabinType}`;
           }
           if (infant != 0 && children == 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${infant} infant, ${cabinType}`;
           }
       }

       function incInfant(numb) {
           const clickedElementId = event.target.id;
           console.log(clickedElementId)
           let inputField, minus, plus;

           infant += numb;

           if (clickedElementId === 'plusInfantOW' || clickedElementId === 'minusInfantOW') {
               document.getElementById("infantOW").textContent = infant;
               inputField = document.getElementById("inputFieldPPLOW");
               minus = document.getElementById("minusInfantOW");
               plus = document.getElementById("plusInfantOW");
           } else if (clickedElementId === 'plusInfantRT' || clickedElementId === 'minusInfantRT') {
               document.getElementById("infantRT").textContent = infant;
               inputField = document.getElementById("inputFieldPPLRT");
               minus = document.getElementById("minusInfantRT");
               plus = document.getElementById("plusInfantRT");
           }

           if (!minus || !plus) {
               console.warn("One of the elements (minus or plus) is undefined. Please check the element IDs.");
           }


           minus.style.cursor = "pointer";
           minus.style.color = "#07A9E2";
           minus.style.pointerEvents = "auto";

           if (infant == 0) {
               minus.style.pointerEvents = "none";
               minus.style.color = "#dbdbdb";
               minus.style.cursor = "auto";

               plus.style.pointerEvents = "auto";
               plus.style.color = "#07A9E2";
               plus.style.cursor = "pointer";
           } else if (infant == 3) {
               plus.style.pointerEvents = "none";
               plus.style.color = "#dbdbdb";
               plus.style.cursor = "auto";
           } else {
               minus.style.color = "#07A9E2";
               minus.style.pointerEvents = "auto";
               minus.style.cursor = "pointer";
           }

           if (infant == 0 && children == 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults`;
           }
           if (infant == 0 && children != 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults, ${children} children`;
           }
           if (infant != 0 && children != 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults, ${children} children, ${infant} infant`;
           }
           if (infant != 0 && children == 0 && cabinType == "") {
               inputField.placeholder = `${adults} adults, ${infant} infant`;
           }

           if (infant == 0 && children == 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${cabinType} cabinType`;
           }
           if (infant == 0 && children != 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${children} children, ${cabinType}`;
           }
           if (infant != 0 && children != 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${children} children, ${infant} infant, ${cabinType}`;
           }
           if (infant != 0 && children == 0 && cabinType != "") {
               inputField.placeholder = `${adults} adults, ${infant} infant, ${cabinType}`;
           }
       }


       function changeTabUI(element) {
           const tabs = document.querySelectorAll(".tab");
           tabs.forEach((tab) => {
               tab.style.borderBottom = "2px solid transparent";
               tab.style.color = "#999999";

               const img = tab.querySelector("img");
               img.style.opacity = "0.6";
               img.style.filter = "brightness(50%) contrast(100%) grayscale(1)";
           });
           element.style.borderBottom = "2px solid #0094E6";

           element.style.color = "#0C1E60";
           const activeImg = element.querySelector("img");
           activeImg.style.filter = "none"; // Apply opacity effect on image
           activeImg.style.opacity = "1";
       }

       function resetStyles(button) {
           button.style.color = "#666666";
           const logoContainer = button.querySelector(".logo-container");
           const farIcon = logoContainer.querySelector(".far");
           const fasIcon = logoContainer.querySelector(".fas");
           const lbl = button.querySelector(".label-name");
           const parent = button.parentElement;

           farIcon.style.display = "inline";
           fasIcon.style.display = "none";
           lbl.style.fontWeight = "400";
           parent.style.backgroundColor = "transparent";
           parent.style.borderColor = "#d5d5d5";
       }

       function oneWay(element) {
           adults = 1;
           children = 0;
           infant = 0
           cabinType = ''
           let inputField = document.getElementById("inputFieldPPLOW");
           inputField.placeholder = `${adults} adults`;


           if (selectedButton) resetStyles(selectedButton);
           selectedButton = element;

           element.style.color = "#0C1E60";
           const logoContainer = element.querySelector(".logo-container");
           const farIcon = logoContainer.querySelector(".far");
           const fasIcon = logoContainer.querySelector(".fas");
           const lbl = element.querySelector(".label-name");
           const parent = document.getElementById("OW");
           console.log(lbl);

           // Toggle icons
           farIcon.style.display = "none";
           fasIcon.style.display = "inline";
           lbl.style.fontWeight = "600";
           parent.style.backgroundColor = "#D0D4DE";
           parent.style.borderColor = "#D0D4DE";

           const el = document.getElementById('owSec');
           el.style.display = 'grid'
           const el1 = document.getElementById('rtSec');
           el1.style.display = 'none'
       }

       function RoundTrip(element) {
           adults = 1;
           children = 0;
           infant = 0
           cabinType = ''
           let inputField = document.getElementById("inputFieldPPLRT");
           inputField.placeholder = `${adults} adults`;

           if (selectedButton) resetStyles(selectedButton);
           selectedButton = element;

           element.style.color = "#0C1E60";
           const logoContainer = element.querySelector(".logo-container");
           const farIcon = logoContainer.querySelector(".far");
           const fasIcon = logoContainer.querySelector(".fas");
           const lbl = element.querySelector(".label-name");
           const parent = document.getElementById("RT");
           console.log(lbl);

           // Toggle icons
           farIcon.style.display = "none";
           fasIcon.style.display = "inline";
           lbl.style.fontWeight = "600";
           parent.style.backgroundColor = "#D0D4DE";
           parent.style.borderColor = "#D0D4DE";

           const el = document.getElementById('rtSec');
           el.style.display = 'grid'
           const el1 = document.getElementById('owSec');
           el1.style.display = 'none'
       }

       function openCard() {
           const clickedElementId = event.target.id;
           console.log(clickedElementId)
           let flight = document.getElementById('card')
           let hotel = document.getElementById('hotel-card')
           let car = document.getElementById('car-card')

           if (clickedElementId == 'flight' || clickedElementId == 'flightLogo' || clickedElementId == 'flightText') {
               flight.style.display = 'flex'
               hotel.style.display = 'none'
               car.style.display = 'none'
           }
           if (clickedElementId == 'hotel' || clickedElementId == 'hotelLogo' || clickedElementId == 'hotelText') {
               flight.style.display = 'none'
               hotel.style.display = 'flex'
               car.style.display = 'none'
           }
           if (clickedElementId == 'car' || clickedElementId == 'carLogo' || clickedElementId == 'carText') {
               flight.style.display = 'none'
               hotel.style.display = 'none'
               car.style.display = 'flex'
           }

       }

       function incRoomAdult(roomId, numb) {
           // Get the current adult count for the specific room
           let adultRoomCount = parseInt(document.getElementById(`adultRoom${roomId}`).textContent);
           let newAdultRoomCount = adultRoomCount + numb;

           // Ensure the count remains between 1 and 9 for each room
           if (newAdultRoomCount < 1) newAdultRoomCount = 1;
           if (newAdultRoomCount > 9) newAdultRoomCount = 9;

           // Update the adult count for the specific room
           document.getElementById(`adultRoom${roomId}`).textContent = newAdultRoomCount;

           // Update total adults across all rooms
           adultRoom = 0; // Reset total adults
           const roomAdultCounts = document.querySelectorAll('[id^="adultRoom"]');
           roomAdultCounts.forEach(room => {
               adultRoom += parseInt(room.textContent); // Sum up the adult counts from each room
           });

           // Get the minus and plus buttons for the specific room
           const minus = document.getElementById(`minusAdultRoom${roomId}`);
           const plus = document.getElementById(`plusAdultRoom${roomId}`);

           // Update cursor and disable/enable state for minus and plus buttons based on the room count
           if (newAdultRoomCount === 1) {
               minus.style.pointerEvents = "none";
               minus.style.color = "#6E7174";
               minus.style.cursor = "auto";
           } else {
               minus.style.pointerEvents = "auto";
               minus.style.color = "#021529";
               minus.style.cursor = "pointer";
           }

           if (newAdultRoomCount === 9) {
               plus.style.pointerEvents = "none";
               plus.style.color = "#6E7174";
               plus.style.cursor = "auto";
           } else {
               plus.style.pointerEvents = "auto";
               plus.style.color = "#021529";
               plus.style.cursor = "pointer";
           }

           // Update the placeholder with the total count of adults (across all rooms) and room count
           const inputField = document.getElementById("room"); // Replace with the correct input field if this is per-room
           inputField.placeholder = `Rooms: ${roomCount}, adults: ${adultRoom}, children: ${childRoom}`;
       }

       function incRoomChildren(roomId, numb) {
           // Get the current child count for the specific room
           let childRoomCount = parseInt(document.getElementById(`childrenRoom${roomId}`).textContent);
           let newChildRoomCount = childRoomCount + numb;

           // Ensure the count remains between 1 and 9 for each room
           if (newChildRoomCount < 0) newChildRoomCount = 0;
           if (newChildRoomCount > 9) newChildRoomCount = 9;

           // Update the child count for the specific room
           document.getElementById(`childrenRoom${roomId}`).textContent = newChildRoomCount;

           // Update total children across all rooms
           childRoom = 0; // Reset total children
           const roomChildCounts = document.querySelectorAll('[id^="childrenRoom"]');
           roomChildCounts.forEach(room => {
               childRoom += parseInt(room.textContent); // Sum up the child counts from each room
           });

           // Get the minus and plus buttons for the specific room
           const minus = document.getElementById(`minusChildrenRoom${roomId}`);
           const plus = document.getElementById(`plusChildrenRoom${roomId}`);

           // Update cursor and disable/enable state for minus and plus buttons based on the room count
           if (newChildRoomCount === 0) {
               minus.style.pointerEvents = "none";
               minus.style.color = "#6E7174";
               minus.style.cursor = "auto";
           } else {
               minus.style.pointerEvents = "auto";
               minus.style.color = "#021529";
               minus.style.cursor = "pointer";
           }

           if (newChildRoomCount === 9) {
               plus.style.pointerEvents = "none";
               plus.style.color = "#6E7174";
               plus.style.cursor = "auto";
           } else {
               plus.style.pointerEvents = "auto";
               plus.style.color = "#021529";
               plus.style.cursor = "pointer";
           }

           // Update the placeholder with the total count of rooms, adults, and children
           const inputField = document.getElementById("room"); // Replace with the correct input field if this is per-room
           inputField.placeholder = `Rooms: ${roomCount}, adults: ${adultRoom}, children: ${childRoom}`;
       }


       // function incRoomChildren(roomId, numb) {
       //     let childRoomCount = 1;
       //     let newChildRoomCount = childRoomCount + numb;
       //     childRoom+=newChildRoomCount

       //     // Ensure the count remains between 1 and 9
       //     if (newChildRoomCount < 1) newChildRoomCount = 1;
       //     if (newChildRoomCount > 9) newChildRoomCount = 9;

       //     // Update the display with the new child count
       //     document.getElementById(`childrenRoom${roomId}`).textContent = newChildRoomCount;

       //     // Get minus and plus buttons for the specified room
       //     const minus = document.getElementById(`minusChildrenRoom${roomId}`);
       //     const plus = document.getElementById(`plusChildrenRoom${roomId}`);

       //     // Update cursor and disable/enable state for minus and plus buttons
       //     if (newChildRoomCount === 1) {
       //         minus.style.pointerEvents = "none";
       //         minus.style.color = "#6E7174";
       //         minus.style.cursor = "auto";
       //     } else {
       //         minus.style.pointerEvents = "auto";
       //         minus.style.color = "#021529";
       //         minus.style.cursor = "pointer";
       //     }

       //     if (newChildRoomCount === 9) {
       //         plus.style.pointerEvents = "none";
       //         plus.style.color = "#6E7174";
       //         plus.style.cursor = "auto";
       //     } else {
       //         plus.style.pointerEvents = "auto";
       //         plus.style.color = "#021529";
       //         plus.style.cursor = "pointer";
       //     }

       //     // Update the placeholder (or any other display element) if needed
       //     const inputField = document.getElementById("room"); // Replace with the correct input field if this is per-room
       //     inputField.placeholder = `Rooms: ${roomCount}, adults: ${adultRoom}, children: ${childRoom}`;
       // }


       let roomCount = 1;




       function addRoom() {
           roomCount++;

           const roomModal = document.getElementById("roomModal");
           const originalRoomSection = document.getElementById("roomSec1");

           // Clone the room section
           const newRoomSection = originalRoomSection.cloneNode(true);

           // Update IDs and texts for the cloned section
           newRoomSection.id = `roomSec${roomCount}`;
           newRoomSection.querySelector(".room-title").textContent = `Room ${roomCount}`;

           // Update adult and children IDs for the cloned section
           const AdultRoom = newRoomSection.querySelector("#adultRoom1");
           const childrenRoom = newRoomSection.querySelector("#childrenRoom1");
           const minusAdult = newRoomSection.querySelector("#minusAdultRoom1");
           const plusAdult = newRoomSection.querySelector("#plusAdultRoom1");
           const minusChildren = newRoomSection.querySelector("#minusChildrenRoom1");
           const plusChildren = newRoomSection.querySelector("#plusChildrenRoom1");
           const inputField = document.getElementById('room')

           // Set unique IDs for adults and children counters
           AdultRoom.id = `adultRoom${roomCount}`;
           childrenRoom.id = `childrenRoom${roomCount}`;
           minusAdult.id = `minusAdultRoom${roomCount}`;
           plusAdult.id = `plusAdultRoom${roomCount}`;
           minusChildren.id = `minusChildrenRoom${roomCount}`;
           plusChildren.id = `plusChildrenRoom${roomCount}`;

           AdultRoom.textContent = "1"; // Initial count for adults
           childrenRoom.textContent = "0";
           // Set unique onclick handlers
           minusAdult.setAttribute("onclick", `incRoomAdult(${roomCount}, -1)`);
           plusAdult.setAttribute("onclick", `incRoomAdult(${roomCount}, 1)`);
           minusChildren.setAttribute("onclick", `incRoomChildren(${roomCount}, -1)`);
           plusChildren.setAttribute("onclick", `incRoomChildren(${roomCount}, 1)`);

           // Assign the removeRoom function to the red cross icon
           const removeIcon = newRoomSection.querySelector(".fa-times");
           removeIcon.setAttribute("onclick", `removeRoom(${roomCount})`);
           removeIcon.style.display = 'block';

           // Insert the new room section before the "Add Room" button
           roomModal.insertBefore(newRoomSection, roomModal.querySelector(".room-btn"));
           console.log(AdultRoom, childRoom)
           inputField.placeholder = `Rooms: ${roomCount}, adults: ${adultRoom}, children: ${childRoom}`;

       }


       function removeRoom(roomId) {
           const inputField = document.getElementById('room')
           const roomSection = document.getElementById(`roomSec${roomId}`);

           // Ensure we don't remove the first room
           if (roomSection && roomSection.id !== 'roomSec1') {
               roomSection.remove();
               roomCount--;
               inputField.placeholder = `Rooms: ${roomCount}, adults: ${adultRoom}, children: ${childRoom}`;

               reorderRoomNumbers();
           } else {
               console.error("Cannot remove the first room or room section not found.");
           }
       }

       function reorderRoomNumbers() {
           const roomSections = document.querySelectorAll(".roomSec");

           roomSections.forEach((section, index) => {
               const title = section.querySelector(".room-title");
               title.textContent = `Room ${index + 1}`;

               // Update the ID and attributes for unique IDs after reordering
               section.id = `roomSec${index + 1}`;

               const adultRoom = section.querySelector(".adultRoom");
               const childrenRoom = section.querySelector(".childrenRoom");
               const minusAdult = section.querySelector(".minusAdultRoom");
               const plusAdult = section.querySelector(".plusAdultRoom");
               const minusChildren = section.querySelector(".minusChildrenRoom");
               const plusChildren = section.querySelector(".plusChildrenRoom");

               // Update IDs for each item
               adultRoom.id = `adultRoom${index + 1}`;
               childrenRoom.id = `childrenRoom${index + 1}`;
               minusAdult.setAttribute("onclick", `incRoomAdult(${index + 1}, -1)`);
               plusAdult.setAttribute("onclick", `incRoomAdult(${index + 1}, 1)`);
               minusChildren.setAttribute("onclick", `incRoomChildren(${index + 1}, -1)`);
               plusChildren.setAttribute("onclick", `incRoomChildren(${index + 1}, 1)`);

               // Set the remove function on the icon
               const removeIcon = section.querySelector(".fa-times");
               removeIcon.setAttribute("onclick", `removeRoom(${index + 1})`);
               removeIcon.style.display = index === 0 ? 'none' : 'block'; // Hide the delete icon for the first room
           });
       }



       function Pickup(element) {
           element.style.color = "#0C1E60";
           const logoContainer = element.querySelector(".logo-container");
           const farIcon = logoContainer.querySelector(".far");
           const fasIcon = logoContainer.querySelector(".fas");
           const lbl = element.querySelector(".label-name");
           const parent = document.getElementById("pickup");
           console.log(lbl);

           // Toggle icons
           farIcon.style.display = "none";
           fasIcon.style.display = "inline";
           lbl.style.fontWeight = "600";
           parent.style.backgroundColor = "#D0D4DE";
           parent.style.borderColor = "#D0D4DE";
       }

       function DiscountCode(element) {
           const thirdRow = document.getElementById('thirdRow');
           thirdRow.style.display = (thirdRow.style.display === "grid") ? "none" : "grid";

           if (thirdRow.style.display === 'grid') {
               discount = true
               document.getElementById('searchBtnCar').style.top = '90%'

               const changeStyleBtn = document.getElementById('changeStyleBtn');
               const btn = document.getElementById('searchBtnCar');

               if (window.innerWidth < 850) {
                   btn.style.top = '94%' // Apply new style
               } else {
                   btn.style.top = '86%' // Remove new style if width > 800
               }
           } else {
               discount = false
               document.getElementById('searchBtnCar').style.top = '86%'
           }





           if (element.style.color == 'rgb(12, 30, 96)') {
               console.log(element.style.color)
               element.style.color = "#666666";
               const logoContainer = element.querySelector(".logo-container");
               const farIcon = logoContainer.querySelector(".far");
               const fasIcon = logoContainer.querySelector(".fas");
               const lbl = element.querySelector(".label-name");
               const parent = element.parentElement;

               farIcon.style.display = "inline";
               fasIcon.style.display = "none";
               lbl.style.fontWeight = "400";
               parent.style.backgroundColor = "transparent";
               parent.style.borderColor = "#d5d5d5";
           } else {
               console.log(element.style.color)



               element.style.color = "#0C1E60";
               const logoContainer = element.querySelector(".logo-container");
               const farIcon = logoContainer.querySelector(".far");
               const fasIcon = logoContainer.querySelector(".fas");
               const lbl = element.querySelector(".label-name");
               const parent = document.getElementById("DC");
               console.log(lbl);

               // Toggle icons
               farIcon.style.display = "none";
               fasIcon.style.display = "inline";
               lbl.style.fontWeight = "600";
               parent.style.backgroundColor = "#D0D4DE";
               parent.style.borderColor = "#D0D4DE";
           }
       }


       const apiUrl = "https://app.staging.tradebloccorporatetravel.com/api/v2/locations";

       document.getElementById("fromCar").addEventListener("input", async (event) => {
           const term = event.target.value;

           // Clear previous results
           const select = document.getElementById("resultsCar");
           select.innerHTML = ""; // Clear existing options

           // Hide the dropdown initially
           const dropdown = document.getElementById("dropdownCar");
           const loader = document.getElementById("loaderCar");
           loader.style.display = "block"; // Show the loader 

           if (term) {
               const response = await fetch(`${apiUrl}?term=${term}&locale=en-US&location_types=city&location_types=airport&active_only=false&sort=name`);

               loader.style.display = "none"
               if (response.ok) {
                   console.log('term', term);
                   const data = await response.json();


                   // Check if there are results and display them
                   if (data.data.length > 0) {
                       data.data.forEach(element => displayResultsCar(element));
                       dropdown.style.display = "block"; // Show the dropdown if there are options
                   }
               } else {
                   loader.style.display = "none";
                   console.error("Error fetching locations", response.statusText);
               }
           }
       });

       document.getElementById("fromFlightOW").addEventListener("input", async (event) => {
           console.log('flight')
           const term = event.target.value;

           // Clear previous results
           const select = document.getElementById("resultsFlightFromOW");
           select.innerHTML = ""; // Clear existing options

           // Hide the dropdown initially
           const dropdown = document.getElementById("dropdownFlightFromOW");
           const loader = document.getElementById("loaderFlightFromOW");
           loader.style.display = "block"; // Show the loader 

           if (term) {
               const response = await fetch(`${apiUrl}?term=${term}&locale=en-US&location_types=city&location_types=airport&active_only=false&sort=name`);

               loader.style.display = "none"
               if (response.ok) {
                   console.log('term', term);
                   const data = await response.json();


                   // Check if there are results and display them
                   if (data.data.length > 0) {
                       data.data.forEach(element => displayResultsFlightFromOW(element));
                       dropdown.style.display = "block"; // Show the dropdown if there are options
                   }
               } else {
                   loader.style.display = "none";
                   console.error("Error fetching locations", response.statusText);
               }
           }
       });

       document.getElementById("fromFlightRT").addEventListener("input", async (event) => {
           console.log('flight')
           const term = event.target.value;

           // Clear previous results
           const select = document.getElementById("resultsFlightFromRT");
           select.innerHTML = ""; // Clear existing options

           // Hide the dropdown initially
           const dropdown = document.getElementById("dropdownFlightFromRT");
           const loader = document.getElementById("loaderFlightFromRT");
           loader.style.display = "block"; // Show the loader 

           if (term) {
               const response = await fetch(`${apiUrl}?term=${term}&locale=en-US&location_types=city&location_types=airport&active_only=false&sort=name`);

               loader.style.display = "none"
               if (response.ok) {
                   console.log('term', term);
                   const data = await response.json();


                   // Check if there are results and display them
                   if (data.data.length > 0) {
                       data.data.forEach(element => displayResultsFlightFromRT(element));
                       dropdown.style.display = "block"; // Show the dropdown if there are options
                   }
               } else {
                   loader.style.display = "none";
                   console.error("Error fetching locations", response.statusText);
               }
           }
       });

       document.getElementById("locHotel").addEventListener("input", async (event) => {
           const term = event.target.value;

           // Clear previous results
           const select = document.getElementById("resultsHotel");
           select.innerHTML = ""; // Clear existing options

           // Hide the dropdown initially
           const dropdown = document.getElementById("dropdownHotel");
           const loader = document.getElementById("loaderHotel");
           loader.style.display = "block"; // Show the loader 

           if (term) {
               const response = await fetch(`${apiUrl}?term=${term}&locale=en-US&location_types=city&location_types=airport&active_only=false&sort=name`);

               loader.style.display = "none"
               if (response.ok) {
                   console.log('term', term);
                   const data = await response.json();


                   // Check if there are results and display them
                   if (data.data.length > 0) {
                       data.data.forEach(element => displayResultsHotel(element));
                       dropdown.style.display = "block"; // Show the dropdown if there are options
                   }
               } else {
                   loader.style.display = "none";
                   console.error("Error fetching locations", response.statusText);
               }
           }
       });

       document.getElementById("toFlightOW").addEventListener("input", async (event) => {
           const term = event.target.value;

           // Clear previous results
           const select = document.getElementById("resultsFlightToOW");
           select.innerHTML = ""; // Clear existing options

           // Hide the dropdown initially
           const dropdown = document.getElementById("dropdownFlightToOW");
           const loader = document.getElementById("loaderFlightToOW");
           loader.style.display = "block"; // Show the loader 

           if (term) {
               const response = await fetch(`${apiUrl}?term=${term}&locale=en-US&location_types=city&location_types=airport&active_only=false&sort=name`);

               loader.style.display = "none"
               if (response.ok) {
                   console.log('term', term);
                   const data = await response.json();


                   // Check if there are results and display them
                   if (data.data.length > 0) {
                       data.data.forEach(element => displayResultsFlightToOW(element));
                       dropdown.style.display = "block"; // Show the dropdown if there are options
                   }
               } else {
                   loader.style.display = "none";
                   console.error("Error fetching locations", response.statusText);
               }
           }
       });

       document.getElementById("toFlightRT").addEventListener("input", async (event) => {
           const term = event.target.value;

           // Clear previous results
           const select = document.getElementById("resultsFlightToRT");
           select.innerHTML = ""; // Clear existing options

           // Hide the dropdown initially
           const dropdown = document.getElementById("dropdownFlightToRT");
           const loader = document.getElementById("loaderFlightToRT");
           loader.style.display = "block"; // Show the loader 

           if (term) {
               const response = await fetch(`${apiUrl}?term=${term}&locale=en-US&location_types=city&location_types=airport&active_only=false&sort=name`);

               loader.style.display = "none"
               if (response.ok) {
                   console.log('term', term);
                   const data = await response.json();


                   // Check if there are results and display them
                   if (data.data.length > 0) {
                       data.data.forEach(element => displayResultsFlightToRT(element));
                       dropdown.style.display = "block"; // Show the dropdown if there are options
                   }
               } else {
                   loader.style.display = "none";
                   console.error("Error fetching locations", response.statusText);
               }
           }
       });


       function displayResultsFlightToOW(location) {
           // Create a new div for each result
           const resultDiv = document.createElement("div");
           resultDiv.className = "select";
           console.log('name', location.name)

           // Set inner HTML with location name and ID
           resultDiv.innerHTML = `
             <div>
                 <i class="fas fa-plane"></i> <!-- Icon can be customized -->
             </div>
             <span class="loc-name">${location.name}</span>
             <span class="loc-id" style="display: flex; justify-content: end;">${location.id}</span>
         `;

           // Append the new result div to the results container
           document.getElementById("resultsFlightToOW").appendChild(resultDiv);

           resultDiv.addEventListener("click", () => {
               console.log("Selected location name:", location.name);
               // Optionally, set the location name to the input field or another element
               document.getElementById("locNameToOW").innerHTML = location.name;
               document.getElementById("locIdToOW").innerHTML = location.id;
               country_code = getCountryCodeFromText(location.slug_en)

               document.getElementById("locCountryToOW").innerHTML = country_code;
               const pill = document.getElementById('pillToOW')
               pill.style.display = 'flex';
               // pill.style.left='6%'
               // pill.style.top='25%'
               pill.setAttribute('title', location.name);

               // Hide the dropdown after selection
               document.getElementById("dropdownFlightToOW").style.display = "none";
           });
       }

       function displayResultsFlightToRT(location) {
           // Create a new div for each result
           const resultDiv = document.createElement("div");
           resultDiv.className = "select";
           console.log('name', location.name)
           console.log('locationName', location)

           // Set inner HTML with location name and ID
           resultDiv.innerHTML = `
             <div>
                 <i class="fas fa-plane"></i> <!-- Icon can be customized -->
             </div>
             <span class="loc-name">${location.name}</span>
             <span class="loc-id" style="display: flex; justify-content: end;">${location.id}</span>
         `;

           // Append the new result div to the results container
           document.getElementById("resultsFlightToRT").appendChild(resultDiv);

           resultDiv.addEventListener("click", () => {
               console.log("Selected location name:", location.name);
               // Optionally, set the location name to the input field or another element
               document.getElementById("locNameToRT").innerHTML = location.name;
               document.getElementById("locIdToRT").innerHTML = location.id;
           country_code = getCountryCodeFromText(location.slug_en)

               document.getElementById("locCountryToRT").innerHTML = country_code;
               
               const pill = document.getElementById('pillToRT')
               pill.style.display = 'flex';
               // pill.style.left='6%'
               // pill.style.top='25%'
               pill.setAttribute('title', location.name);

               // Hide the dropdown after selection
               document.getElementById("dropdownFlightToRT").style.display = "none";
           });
       }




       function displayResultsHotel(location) {
           // Create a new div for each result
           const resultDiv = document.createElement("div");
           resultDiv.className = "select";
           console.log('name', location.name)

           // Set inner HTML with location name and ID
           resultDiv.innerHTML = `
             <div>
                 <i class="fas fa-plane"></i> <!-- Icon can be customized -->
             </div>
             <span class="loc-name">${location.name}</span>
             <span class="loc-id" style="display: flex; justify-content: end;">${location.id}</span>
         `;

           // Append the new result div to the results container
           document.getElementById("resultsHotel").appendChild(resultDiv);

           resultDiv.addEventListener("click", () => {
               console.log("Selected location name:", location.name);
               // Optionally, set the location name to the input field or another element
               document.getElementById("locNameHotel").innerHTML = location.name;
               document.getElementById("locIdHotel").innerHTML = location.id;
           country_code = getCountryCodeFromText(location.slug_en)

               document.getElementById("locCountryHotel").innerHTML =country_code;
               const pill = document.getElementById('pillHotel')
               pill.style.display = 'flex';
               // pill.style.left='6%'
               // pill.style.top='25%'
               pill.setAttribute('title', location.name);

               // Hide the dropdown after selection
               document.getElementById("dropdownHotel").style.display = "none";
           });
       }




       function displayResultsFlightFromOW(location) {
           // Create a new div for each result
           const resultDiv = document.createElement("div");
           resultDiv.className = "select";

           // Set inner HTML with location name and ID
           resultDiv.innerHTML = `
             <div>
                 <i class="fas fa-plane"></i> <!-- Icon can be customized -->
             </div>
             <span class="loc-name">${location.name}</span>
             <span class="loc-id" style="display: flex; justify-content: end;">${location.id}</span>
         `;

           // Append the new result div to the results container
           document.getElementById("resultsFlightFromOW").appendChild(resultDiv);

           resultDiv.addEventListener("click", () => {
               console.log("Selected location name:", location.name);
               // Optionally, set the location name to the input field or another element
               document.getElementById("locNameFromOW").innerHTML = location.name;
               document.getElementById("locIdFromOW").innerHTML = location.id;
            country_code = getCountryCodeFromText(location.slug_en);

               document.getElementById("locCountryFromOW").innerHTML = country_code;
               const pill = document.getElementById('pillFromOW')
               pill.style.display = 'flex';
               // pill.style.left='6%'
               // pill.style.top='25%'
               pill.setAttribute('title', location.name);

               // Hide the dropdown after selection
               document.getElementById("dropdownFlightFromOW").style.display = "none";
           });
       }

       function displayResultsFlightFromRT(location) {
           // Create a new div for each result
           const resultDiv = document.createElement("div");
           resultDiv.className = "select";
           country_code = getCountryCodeFromText(location.slug_en);

           // Set inner HTML with location name and ID
           resultDiv.innerHTML = `
             <div>
                 <i class="fas fa-plane"></i> <!-- Icon can be customized -->
             </div>
             <span class="loc-name">${location.name}</span>
             <span class="loc-id" style="display: flex; justify-content: end;">${location.id}</span>
         `;

           // Append the new result div to the results container
           document.getElementById("resultsFlightFromRT").appendChild(resultDiv);

           resultDiv.addEventListener("click", () => {
               console.log("Selected location name:", location.name);
               // Optionally, set the location name to the input field or another element
               document.getElementById("locNameFromRT").innerHTML = location.name;
               document.getElementById("locIdFromRT").innerHTML = location.id;
               country_code = getCountryCodeFromText(location.slug_en);
               document.getElementById("locCountryFromRT").innerHTML = country_code;
               const pill = document.getElementById('pillFromRT')
               pill.style.display = 'flex';
               // pill.style.left='6%'
               // pill.style.top='25%'
               pill.setAttribute('title', location.name);

               // Hide the dropdown after selection
               document.getElementById("dropdownFlightFromRT").style.display = "none";
           });
       }

       function displayResultsCar(location) {
           // Create a new div for each result
           const resultDiv = document.createElement("div");
           resultDiv.className = "select";
           // Set inner HTML with location name and ID
           resultDiv.innerHTML = `
             <div>
                 <i class="fas fa-plane"></i> <!-- Icon can be customized -->
             </div>
             <span class="loc-name">${location.name}</span>
             <span class="loc-id" style="display: flex; justify-content: end;">${location.id}</span>
         `;

           // Append the new result div to the results container
           document.getElementById("resultsCar").appendChild(resultDiv);

           resultDiv.addEventListener("click", () => {
               console.log("Selected location name:", location.name);
               // Optionally, set the location name to the input field or another element
               document.getElementById("locNameCar").innerHTML = location.name;
               document.getElementById("locIdCar").innerHTML = location.id;
               country_code = getCountryCodeFromText(location.slug_en)
               console.log(country_code, ' Country')
               document.getElementById("locCountryCar").innerHTML = country_code;
               const pill = document.getElementById('pillCar')
               pill.style.display = 'flex';
               // pill.style.left='6%'
               // pill.style.top='25%'
               pill.setAttribute('title', location.name);

               // Hide the dropdown after selection
               document.getElementById("dropdownCar").style.display = "none";
           });
       }

       document.addEventListener("click", (event) => {
           const dropdownCar = document.getElementById("dropdownCar");
           const dropdownFlightRT = document.getElementById("dropdownFlightFromRT");
           const dropdownFlightOW = document.getElementById("dropdownFlightFromOW");
           const dropdownHotel = document.getElementById("dropdownHotel");
           const fromCar = document.getElementById("fromCar");
           const fromFlightRT = document.getElementById("fromFlightRT");
           const fromFlightOW = document.getElementById("fromFlightOW");
           const locHotel = document.getElementById("locHotel");

           // Hide dropdown if click is outside both input fields and dropdowns
           if (
               !dropdownCar.contains(event.target) &&
               !dropdownFlightRT.contains(event.target) &&
               !dropdownFlightOW.contains(event.target) &&
               !dropdownHotel.contains(event.target) &&
               event.target !== fromCar &&
               event.target !== fromFlightRT &&
               event.target !== fromFlightRT &&
               event.target !== locHotel
           ) {
               dropdownCar.style.display = "none";
               dropdownFlightRT.style.display = "none";
               dropdownFlightOW.style.display = "none";
           }
       });

       function closePillCar() {
           document.getElementById('pillCar').style.display = 'none'
           document.getElementById('fromCar').value = '';
       }

       function closePillHotel() {
           document.getElementById('pillHotel').style.display = 'none'
           document.getElementById('locHotel').value = '';
       }

       function closePillFromRT() {
           document.getElementById('pillFromRT').style.display = 'none'
           document.getElementById('fromFlightRT').value = '';
       }

       function closePillToRT() {
           document.getElementById('pillToRT').style.display = 'none'
           document.getElementById('toFlightRT').value = '';
       }

       function closePillFromOW() {
           document.getElementById('pillFromOW').style.display = 'none'
           document.getElementById('fromFlightOW').value = '';
       }

       function closePillToOW() {
           document.getElementById('pillToOW').style.display = 'none'
           document.getElementById('toFlightOW').value = '';
       }

       function submitFlightOW() {

           // Get the values from the DOM elements
           const from = document.getElementById('locNameFromOW').innerHTML;
           const fromCode = document.getElementById('locIdFromOW').innerHTML;
           const fromCountryCode = document.getElementById('locCountryFromOW').innerHTML;

           const to = document.getElementById('locNameToOW').innerHTML;
           const toCode = document.getElementById('locIdToOW').innerHTML;
           const toCountryCode = document.getElementById('locCountryToOW').innerHTML;
           const date = document.getElementById('datepicker').value; // Get the raw date from the date picker

           const ppl = document.getElementById('inputFieldPPLOW').placeholder; // Get the passengers description
           const type = 'airport'

           // Check if any field is empty
           if (!from || !to || !date || !ppl) {
               console.log('empty fields, OW');
               return;

           } else {
             

               // Generate the passengers query string
                const passengerParams = extractPassengers(ppl);

            const obj = {
                from: from,
                fromCode: fromCode,
                fromCountryCode: fromCountryCode,
                to: to,
                toCode: toCode,
                toCountryCode: toCountryCode,
                depdate: date,
                type: 'OW'
            };

            console.log('submitted ', obj);

            function createSearchURL(params, passengers) {
                const tripleEncode = (value) => encodeURIComponent(encodeURIComponent(encodeURIComponent(value)));

                const searchParams = `type%253D${tripleEncode(params.type)}%2526` +
                    `passengers%253D${tripleEncode(passengers)}%2526` +
                    `params%253Dfrom%25253Did%2525253D${tripleEncode(params.fromCode)}%25252526type%2525253Dairport%25252526name%2525253D${tripleEncode(params.from)}%25252526code%2525253D${tripleEncode(params.fromCode)}%25252526countryCode%2525253D${tripleEncode(params.fromCountryCode)}%252526` +
                    `to%25253Did%2525253D${tripleEncode(params.toCode)}%25252526type%2525253Dairport%25252526name%2525253D${tripleEncode(params.to)}%25252526code%2525253D${tripleEncode(params.toCode)}%25252526countryCode%2525253D${tripleEncode(params.toCountryCode)}%252526` +
                    `dep_date%25253D${tripleEncode(params.depdate)}%252526` +
                    `cabin%25253D`; // Empty value for 'cabin'

                return `https://app.staging.tradebloccorporatetravel.com/flights/search?searchParams=${searchParams}`;
            }

            // Generate the URL
            const url = createSearchURL(obj, passengerParams);

            console.log('Generated URL:', url);


               // Get the iframe element by ID
               const iframe = document.getElementById('flightIframe');


               // Log the current src to check if it's updating
               console.log('Current iframe src:', iframe.src);

               // Update the iframe's src with the new URL
               iframe.style.display = 'block';
               iframe.src = url;

               // Log the updated iframe src
               console.log('Updated iframe src:', iframe.src);
           }



       }

       // Function to extract passenger details and generate the query
       function extractPassengers(ppl) {
           // Initialize default values
           let adults = 0;
           let children = 0;
           let infants = 0;

           // Split the input string into an array of descriptors (e.g., "1 adults", "1 children")
           const parts = ppl.split(',');

           // Parse each part to determine the counts for adults, children, and infants
           parts.forEach(part => {
               part = part.trim(); // Remove leading/trailing spaces
               if (part.includes('adults')) {
                   adults = parseInt(part.split(' ')[0]) || 0;
               } else if (part.includes('children')) {
                   children = parseInt(part.split(' ')[0]) || 0;
               } else if (part.includes('infants')) {
                   infants = parseInt(part.split(' ')[0]) || 0;
               }
           });

           // Calculate the total number of seats
           const seats = adults + children + infants;

           // Return the generated query parameters
           return `seats=${seats}&adults=${adults}&children=${children}&infants=${infants}`;
       }



       function submitFlightRT() {
           const from = document.getElementById('locNameFromRT').innerHTML
           const fromCode = document.getElementById('locIdFromRT').innerHTML;
           const fromCountryCode = document.getElementById('locCountryFromRT').innerHTML;

           const to = document.getElementById('locNameToRT').innerHTML
           const toCode = document.getElementById('locIdToRT').innerHTML;
           const toCountryCode = document.getElementById('locCountryToRT').innerHTML;

           const depDate = document.getElementById('depDateFRT').value
           const retDate = document.getElementById('retDateFRT').value
           const select = document.getElementById('returnTimeSelectFRT').value
           const ppl = document.getElementById('inputFieldPPLRT').placeholder


           if (!from || !to || !depDate || !ppl || !retDate || !select) {
               console.log('empty field in submitFlightRT')
               return
           } else {

               // Generate the passengers query string
               const passengerParams = extractPassengers(ppl);

                const obj = {
                    from: from, // Departure location name
                    fromCode: fromCode, // Departure location code
                    fromCountryCode: fromCountryCode, // Departure location country code

                    to: to, // Arrival location name
                    toCode: toCode, // Arrival location code
                    toCountryCode: toCountryCode, // Arrival location country code

                    depdate: depDate, // Departure date
                    retdate: retDate, // Return date
                    ret_time: select, // Return time
                    type: 'RT', // Round-trip type
                    cabin: ''
                };

                console.log('submitted ', obj);

                function createSearchURL(params, passengers) {
                    const tripleEncode = (value) => encodeURIComponent(encodeURIComponent(encodeURIComponent(value)));

                    const searchParams = `type%253D${tripleEncode(params.type)}%2526` +
                        `passengers%253D${tripleEncode(passengers)}%2526` +
                        `params%253Dfrom%25253Did%2525253D${tripleEncode(params.fromCode)}%25252526type%2525253Dairport%25252526name%2525253D${tripleEncode(params.from)}%25252526code%2525253D${tripleEncode(params.fromCode)}%25252526countryCode%2525253D${tripleEncode(params.fromCountryCode)}%252526` +
                        `to%25253Did%2525253D${tripleEncode(params.toCode)}%25252526type%2525253Dairport%25252526name%2525253D${tripleEncode(params.to)}%25252526code%2525253D${tripleEncode(params.toCode)}%25252526countryCode%2525253D${tripleEncode(params.toCountryCode)}%252526` +
                        `dep_date%25253D${tripleEncode(params.depdate)}%252526` +
                        `ret_date%25253D${tripleEncode(params.retdate)}%252526` +
                        `ret_time%25253D${tripleEncode(params.ret_time)}%252526` +
                        `cabin%25253D${tripleEncode(params.cabin)}`;

                    return `https://app.staging.tradebloccorporatetravel.com/flights/search?searchParams=${searchParams}`;
                }



            // Generate the URL
            const url = createSearchURL(obj, passengerParams);

            console.log('Generated URL:', url);

            // Get the iframe element by ID
            const iframe = document.getElementById('flightIframe');

            // Log the current src to check if it's updating
            console.log('Current iframe src:', iframe.src);

            // Update the iframe's src with the new URL
            iframe.style.display = 'block';
            iframe.src = url;

            // Log the updated iframe src
            console.log('Updated iframe src:', iframe.src);

        
        }

       }


       function submitCar() {
           // Get the values from the DOM elements
            const locNameCar = document.getElementById('locNameCar').innerHTML.trim();
            const locIdCar = document.getElementById('locIdCar').innerHTML.trim();
            const locCountryCar = document.getElementById('locCountryCar').innerHTML.trim();

            const depDateCar = document.getElementById('depDateCar').value.trim();
            const retDateCar = document.getElementById('retDateCar').value.trim();
            let retTimeCar = document.getElementById('retTimeCar').value.trim();
            let checkoutCar = document.getElementById('checkoutCar').value.trim();
            const discType = document.getElementById('discType').value.trim();
            const discCompany = document.getElementById('discCompany').value.trim();
            const discCode = document.getElementById('discCode').value.trim();

            // Add a colon to the time if it's in the HHMM format
            if (retTimeCar.length === 4) {
            retTimeCar = retTimeCar.substring(0, 2) + ':' + retTimeCar.substring(2);
            }

            // Add a colon to the time if it's in the HHMM format
            if (checkoutCar.length === 4) {
                checkoutCar = checkoutCar.substring(0, 2) + ':' + checkoutCar.substring(2);
            }

            // Check if required fields are filled
            if (!locNameCar || !checkoutCar || !retDateCar || !retTimeCar) {
                console.log('empty field');
                return;
            }

            const obj = {
                locIdCar: locIdCar,
                locNameCar: locNameCar,
                locCountryCar: locCountryCar,
                depDateCar: depDateCar,
                retDateCar: retDateCar,
                retTimeCar: retTimeCar,
                depTimeCar: checkoutCar,
                specific: false, // default value for `specific`
                discount: !!(discType && discCompany && discCode) // true if discount details are provided
            };

        // Function to create the search URL
        function createSearchURL(params) {
        let searchParams = `specific%253D${encodeURIComponent(params.specific)}%2526` +
        `cityOrAirport%253Did%25253D${encodeURIComponent(params.locIdCar)}%252526` +
        `type%25253Dairport%252526name%25253D${encodeURIComponent(params.locNameCar)}%252526` +
        `code%25253D${encodeURIComponent(params.locIdCar)}%252526` +
        `countryCode%25253D${encodeURIComponent(params.locCountryCar)}%2526` +
        `dep_date%253D${encodeURIComponent(encodeURIComponent(params.depDateCar))}%2526` + // Double-encoded dep_date
        `dep_time%253D${encodeURIComponent(encodeURIComponent(params.depTimeCar))}%2526` + // Double-encoded dep_time
        `ret_date%253D${encodeURIComponent(encodeURIComponent(params.retDateCar))}%2526` + // Double-encoded ret_date
        `ret_time%253D${encodeURIComponent(encodeURIComponent(params.retTimeCar))}%2526` + // Double-encoded ret_time
        `discount%253D${encodeURIComponent(params.discount)}`;

    // Include discount details if they exist
    if (params.discount) {
        searchParams += `%2526disc_type%253D${encodeURIComponent(encodeURIComponent(params.discType))}%2526` +
            `disc_company%253D${encodeURIComponent(encodeURIComponent(params.discCompany))}%2526` +
            `disc_code%253D${encodeURIComponent(encodeURIComponent(params.discCode))}`;
    }

                return `https://app.staging.tradebloccorporatetravel.com/cars/search?searchParams=${searchParams}`;
            }

            // Generate the URL
            const url = createSearchURL(obj);

            console.log('Generated URL:', url);

            // Update the iframe's src with the new URL
            const iframe = document.getElementById('flightIframe');

            if (iframe) {
                console.log('Current iframe src:', iframe.src);
                iframe.style.display = 'block';
                iframe.src = url;
                console.log('Updated iframe src:', iframe.src);
            } else {
                console.error('Iframe element not found');
            }


       }

       function searchCars(args) {
           const _format = "M/D/YYYY_HH:mm";
           const body = {
               start_time: formatDate(args.dep_date, args.dep_time),
               end_time: formatDate(args.ret_date, args.ret_time),
               location: args.cityOrAirport?.code, // Assuming cityOrAirport is defined
               searchType: "airport", // Assuming search is for an airport, change as needed
               sortBy: "LOW",
               vehicleRentalPrefTypes: ["****"], // Assuming this is fixed for now
               filteringOptionsType: "IN",
           };

           const providerSpecificOption = {};

           // If discount-related fields are provided
           if (
               args.discount &&
               args.discount_type &&
               args.discount_code &&
               args.discount_company
           ) {
               body.discountCodes = [{
                   type: args.discount_type,
                   code: args.discount_code
               }, ];
               providerSpecificOption.companyCode = args.discount_company;

               if (args.specific && args.location) {
                   providerSpecificOption.locationCode = args.location.locationCode;
               }
           } else if (args.specific && args.location) {
               providerSpecificOption.companyCode = args.location.companyCode;
               providerSpecificOption.locationCode = args.location.locationCode;
           }

           if (providerSpecificOption.companyCode || providerSpecificOption.locationCode) {
               body.providerSpecificOptions = [providerSpecificOption];
           }

           // Now send the modified payload with fetch
           fetch("https://app.staging.tradebloccorporatetravel.com/api/v2/car/availability", {
                   method: "POST",
                   headers: {
                       "Content-Type": "application/json",
                   },
                   body: JSON.stringify(body),
               })
               .then(response => response.json())
               .then(data => console.log("Response data:", data))
               .catch(error => console.error("Error:", error));


       }
       // Utility function to format date and time
       function formatDate(date, time) {
           // Split the date and time into respective parts
           const [month, day, year] = date.split("/"); // M/D/YYYY
           const [hours, minutes] = time.split(":"); // HH:mm

           // Create a new Date object using the provided date and time
           const formattedDate = new Date(year, month - 1, day, hours, minutes);

           // Return the formatted date in "MM/DD/YYYY, HH:mm AM/PM" format
           return formattedDate.toLocaleString("en-US");
       }


    function submitHotel() {
    
    // Get the values from the DOM elements
    const locNameHotel = document.getElementById('locNameHotel').innerHTML.trim();
    const locIdHotel = document.getElementById('locIdHotel').innerHTML.trim();
    const locCountryHotel = document.getElementById('locCountryHotel').innerHTML.trim();
    const checkin = document.getElementById('checkin').value.trim();
    const checkout = document.getElementById('checkout').value.trim();
    const room = document.getElementById('room').placeholder.trim();

// Check if any field is empty
    if (!locNameHotel || !locIdHotel || !locCountryHotel || !checkin || !checkout || !room) {
        console.log('empty field');
        return;
    } else {
        // Create the object with all the search parameters
        const obj = {
            locNameHotel: locNameHotel,
            locIdHotel: locIdHotel,
            locCountryHotel: locCountryHotel,
            checkin: checkin,
            checkout: checkout,
            room: room
        };

        console.log('Submitted object:', obj);

        // Function to create the search URL
        function createSearchURL(params) {
            const searchParams = `location%253Did%25253D${encodeURIComponent(params.locIdHotel)}%252526` +
                `type%25253Dairport%252526name%25253D${encodeURIComponent(params.locNameHotel)}%252526` +
                `code%25253D${encodeURIComponent(params.locIdHotel)}%252526` +
                `countryCode%25253D${encodeURIComponent(params.locCountryHotel)}%2526` +
                `check_in%253D${encodeURIComponent(encodeURIComponent(encodeURIComponent(params.checkin)))}%2526` + // Triple encoding for check_in
                `check_out%253D${encodeURIComponent(encodeURIComponent(encodeURIComponent(params.checkout)))}%2526` + // Triple encoding for check_out
                `rooms%253D0%25253Dadults%2525253D1%25252526children%2525253D0`; // Match first URL format

            return `https://app.staging.tradebloccorporatetravel.com/hotels/search?searchParams=${searchParams}`;
        }

        // Generate the URL
        const url = createSearchURL(obj);

        console.log('Generated URL:', url);


    console.log('Generated URL:', url);

    // Update the iframe's src with the new URL
    const iframe = document.getElementById('flightIframe');

    if (iframe) {
        console.log('Current iframe src:', iframe.src);
        iframe.style.display = 'block';
        iframe.src = url;
        console.log('Updated iframe src:', iframe.src);
    } else {
        console.error('Iframe element not found');
    }
}
    }

// Function to handle encoding query parameters
function encodeQueryParams(params) {
    return Object.entries(params)
        .map(([key, value]) => `${encodeURIComponent(key)}=${encodeURIComponent(value)}`)
        .join('&');
}

       function updateSearchParams(params) {
           // Placeholder for behavior similar to BehaviorSubject updates
           // In a more complex setup, you might store this in app state or session storage
           console.log("Updated search params:", params);
       }

       function encodeQueryParams(params) {
           return Object.keys(params)
               .map(key => `${encodeURIComponent(key)}=${encodeURIComponent(params[key].toString().replace(/\s/g, '_'))}`)
               .join('&');
       }

       let formLoading = false; // Emulate loading state

       function setSearchParams(params) {
           // This function would "store" the search parameters for access elsewhere in the app.
           console.log("Search parameters set:", params);
       }

       function searchLoaded(isLoaded) {
           formLoading = isLoaded;
           console.log("Search loading state:", formLoading ? "Loaded" : "Loading");
       }

       const env = {
           apiUrl: "https://app.staging.tradebloccorporatetravel.com/api" // Replace this with the actual API base URL
       };


       function searchHotels(body) {
           return fetch(`${env.apiUrl}/v2/stays-v2/search`, {
                   method: 'POST',
                   headers: {
                       'Content-Type': 'application/json'
                   },
                   body: JSON.stringify(body)
               })
               .then(response => {
                   if (!response.ok) throw new Error('Network response was not ok');
                   return response.json();
               })
               .then(res => {
                   if (res.statusCode !== 200) {
                       console.error('Error:', res.errMsg);
                       return null;
                   }

                   // Structure the response to match IHotelAvailabilityResponse
                   return {
                       data: {
                           hotelsData: {
                               hotels: res.data.hotelsData.hotels,
                               rooms: res.data.hotelsData.rooms,
                               services: res.data.hotelsData.services,
                               _MoreDataEchoToken: res.data.hotelsData._MoreDataEchoToken || null
                           },
                           session: res.data.session,
                           id: res.data.id || null
                       },
                       errMsg: res.errMsg,
                       statusCode: res.statusCode
                   };
               })
               .catch(error => {
                   console.error('Error:', error);
                   return null;
               });
       }

       function searchFlights(args) {
           // Set up the request body based on flight type
           const body = {
               origin: args.from,
               destination: args.to,
               departure: formatDate(args.depdate),
               recommendations: 200,
               flightTypes: ["N", "D", "C"]
           };

           // Additional parameters based on flight type
           if (args.type === "RT" && args.ret_date) {
               body.return_date = formatDate(args.retdate);
               body.return_time = args.ret_time;
               body.return_time_window = "2";
           }

           console.log("Sending search request with body:", body);

           fetch(`${env.apiUrl}/v2/shopping/flight_search`, {
                   method: 'POST',
                   headers: {
                       'Content-Type': 'application/json'
                   },
                   body: JSON.stringify(body)
               })
               .then(response => {
                   if (!response.ok) throw new Error('Network response was not ok');
                   return response.json();
               })
               .then(res => {
                   if (res.statusCode !== 200) {
                       console.error('Error:', res.errMsg);
                       return null;
                   }

                   console.log("Flight search result:", res);
                   return res;
               })
               .catch(error => {
                   console.error('Error:', error);
               });
       }

       // Helper function to format date as needed
       function formatDate(dateStr) {
           let day, month, year;

           // Check if the date uses '/' as the separator (e.g., "M/D/YYYY")
           if (dateStr.includes('/')) {
               [month, day, year] = dateStr.split('/');
           }
           // Otherwise, assume '-' as the separator (e.g., "DD-MM-YYYY")
           else if (dateStr.includes('-')) {
               [day, month, year] = dateStr.split('-');
           } else {
               console.error("Invalid date format");
               return "";
           }

           // Ensure we have valid values
           if (!day || !month || !year) {
               console.error("Date string is missing day, month, or year values");
               return "";
           }

           console.log("Day:", day);
           console.log("Month:", month);
           console.log("Year:", year);

           // Format to "DDMMYY"
           return `${day}${month}${year.slice(-2)}`;
       }

       const countries = [{
               name: "Afghanistan",
               code: "AF"
           },
           {
               name: "Albania",
               code: "AL"
           },
           {
               name: "Algeria",
               code: "DZ"
           },
           {
               name: "Andorra",
               code: "AD"
           },
           {
               name: "Angola",
               code: "AO"
           },
           {
               name: "Antigua and Barbuda",
               code: "AG"
           },
           {
               name: "Argentina",
               code: "AR"
           },
           {
               name: "Armenia",
               code: "AM"
           },
           {
               name: "Australia",
               code: "AU"
           },
           {
               name: "Austria",
               code: "AT"
           },
           {
               name: "Azerbaijan",
               code: "AZ"
           },
           {
               name: "Bahamas",
               code: "BS"
           },
           {
               name: "Bahrain",
               code: "BH"
           },
           {
               name: "Bangladesh",
               code: "BD"
           },
           {
               name: "Barbados",
               code: "BB"
           },
           {
               name: "Belarus",
               code: "BY"
           },
           {
               name: "Belgium",
               code: "BE"
           },
           {
               name: "Belize",
               code: "BZ"
           },
           {
               name: "Benin",
               code: "BJ"
           },
           {
               name: "Bhutan",
               code: "BT"
           },
           {
               name: "Bolivia",
               code: "BO"
           },
           {
               name: "Bosnia and Herzegovina",
               code: "BA"
           },
           {
               name: "Botswana",
               code: "BW"
           },
           {
               name: "Brazil",
               code: "BR"
           },
           {
               name: "Brunei",
               code: "BN"
           },
           {
               name: "Bulgaria",
               code: "BG"
           },
           {
               name: "Burkina Faso",
               code: "BF"
           },
           {
               name: "Burundi",
               code: "BI"
           },
           {
               name: "Cabo Verde",
               code: "CV"
           },
           {
               name: "Cambodia",
               code: "KH"
           },
           {
               name: "Cameroon",
               code: "CM"
           },
           {
               name: "Canada",
               code: "CA"
           },
           {
               name: "Central African Republic",
               code: "CF"
           },
           {
               name: "Chad",
               code: "TD"
           },
           {
               name: "Chile",
               code: "CL"
           },
           {
               name: "China",
               code: "CN"
           },
           {
               name: "Colombia",
               code: "CO"
           },
           {
               name: "Comoros",
               code: "KM"
           },
           {
               name: "Congo (Congo-Brazzaville)",
               code: "CG"
           },
           {
               name: "Costa Rica",
               code: "CR"
           },
           {
               name: "Croatia",
               code: "HR"
           },
           {
               name: "Cuba",
               code: "CU"
           },
           {
               name: "Cyprus",
               code: "CY"
           },
           {
               name: "Czechia (Czech Republic)",
               code: "CZ"
           },
           {
               name: "Denmark",
               code: "DK"
           },
           {
               name: "Djibouti",
               code: "DJ"
           },
           {
               name: "Dominica",
               code: "DM"
           },
           {
               name: "Dominican Republic",
               code: "DO"
           },
           {
               name: "Ecuador",
               code: "EC"
           },
           {
               name: "Egypt",
               code: "EG"
           },
           {
               name: "El Salvador",
               code: "SV"
           },
           {
               name: "Equatorial Guinea",
               code: "GQ"
           },
           {
               name: "Eritrea",
               code: "ER"
           },
           {
               name: "Estonia",
               code: "EE"
           },
           {
               name: "Eswatini (fmr. Swaziland)",
               code: "SZ"
           },
           {
               name: "Ethiopia",
               code: "ET"
           },
           {
               name: "Fiji",
               code: "FJ"
           },
           {
               name: "Finland",
               code: "FI"
           },
           {
               name: "France",
               code: "FR"
           },
           {
               name: "Gabon",
               code: "GA"
           },
           {
               name: "Gambia",
               code: "GM"
           },
           {
               name: "Georgia",
               code: "GE"
           },
           {
               name: "Germany",
               code: "DE"
           },
           {
               name: "Ghana",
               code: "GH"
           },
           {
               name: "Greece",
               code: "GR"
           },
           {
               name: "Grenada",
               code: "GD"
           },
           {
               name: "Guatemala",
               code: "GT"
           },
           {
               name: "Guinea",
               code: "GN"
           },
           {
               name: "Guinea-Bissau",
               code: "GW"
           },
           {
               name: "Guyana",
               code: "GY"
           },
           {
               name: "Haiti",
               code: "HT"
           },
           {
               name: "Honduras",
               code: "HN"
           },
           {
               name: "Hungary",
               code: "HU"
           },
           {
               name: "Iceland",
               code: "IS"
           },
           {
               name: "India",
               code: "IN"
           },
           {
               name: "Indonesia",
               code: "ID"
           },
           {
               name: "Iran",
               code: "IR"
           },
           {
               name: "Iraq",
               code: "IQ"
           },
           {
               name: "Ireland",
               code: "IE"
           },
           {
               name: "Israel",
               code: "IL"
           },
           {
               name: "Italy",
               code: "IT"
           },
           {
               name: "Jamaica",
               code: "JM"
           },
           {
               name: "Japan",
               code: "JP"
           },
           {
               name: "Jordan",
               code: "JO"
           },
           {
               name: "Kazakhstan",
               code: "KZ"
           },
           {
               name: "Kenya",
               code: "KE"
           },
           {
               name: "Kiribati",
               code: "KI"
           },
           {
               name: "Korea (North)",
               code: "KP"
           },
           {
               name: "Korea (South)",
               code: "KR"
           },
           {
               name: "Kuwait",
               code: "KW"
           },
           {
               name: "Kyrgyzstan",
               code: "KG"
           },
           {
               name: "Laos",
               code: "LA"
           },
           {
               name: "Latvia",
               code: "LV"
           },
           {
               name: "Lebanon",
               code: "LB"
           },
           {
               name: "Lesotho",
               code: "LS"
           },
           {
               name: "Liberia",
               code: "LR"
           },
           {
               name: "Libya",
               code: "LY"
           },
           {
               name: "Liechtenstein",
               code: "LI"
           },
           {
               name: "Lithuania",
               code: "LT"
           },
           {
               name: "Luxembourg",
               code: "LU"
           },
           {
               name: "Madagascar",
               code: "MG"
           },
           {
               name: "Malawi",
               code: "MW"
           },
           {
               name: "Malaysia",
               code: "MY"
           },
           {
               name: "Maldives",
               code: "MV"
           },
           {
               name: "Mali",
               code: "ML"
           },
           {
               name: "Malta",
               code: "MT"
           },
           {
               name: "Marshall Islands",
               code: "MH"
           },
           {
               name: "Mauritania",
               code: "MR"
           },
           {
               name: "Mauritius",
               code: "MU"
           },
           {
               name: "Mexico",
               code: "MX"
           },
           {
               name: "Micronesia",
               code: "FM"
           },
           {
               name: "Moldova",
               code: "MD"
           },
           {
               name: "Monaco",
               code: "MC"
           },
           {
               name: "Mongolia",
               code: "MN"
           },
           {
               name: "Montenegro",
               code: "ME"
           },
           {
               name: "Morocco",
               code: "MA"
           },
           {
               name: "Mozambique",
               code: "MZ"
           },
           {
               name: "Myanmar (formerly Burma)",
               code: "MM"
           },
           {
               name: "Namibia",
               code: "NA"
           },
           {
               name: "Nauru",
               code: "NR"
           },
           {
               name: "Nepal",
               code: "NP"
           },
           {
               name: "Netherlands",
               code: "NL"
           },
           {
               name: "New Zealand",
               code: "NZ"
           },
           {
               name: "Nicaragua",
               code: "NI"
           },
           {
               name: "Niger",
               code: "NE"
           },
           {
               name: "Nigeria",
               code: "NG"
           },
           {
               name: "North Macedonia",
               code: "MK"
           },
           {
               name: "Norway",
               code: "NO"
           },
           {
               name: "Oman",
               code: "OM"
           },
           {
               name: "Pakistan",
               code: "PK"
           },
           {
               name: "Palau",
               code: "PW"
           },
           {
               name: "Palestine State",
               code: "PS"
           },
           {
               name: "Panama",
               code: "PA"
           },
           {
               name: "Papua New Guinea",
               code: "PG"
           },
           {
               name: "Paraguay",
               code: "PY"
           },
           {
               name: "Peru",
               code: "PE"
           },
           {
               name: "Philippines",
               code: "PH"
           },
           {
               name: "Poland",
               code: "PL"
           },
           {
               name: "Portugal",
               code: "PT"
           },
           {
               name: "Qatar",
               code: "QA"
           },
           {
               name: "Romania",
               code: "RO"
           },
           {
               name: "Russia",
               code: "RU"
           },
           {
               name: "Rwanda",
               code: "RW"
           },
           {
               name: "Saint Kitts and Nevis",
               code: "KN"
           },
           {
               name: "Saint Lucia",
               code: "LC"
           },
           {
               name: "Saint Vincent and the Grenadines",
               code: "VC"
           },
           {
               name: "Samoa",
               code: "WS"
           },
           {
               name: "San Marino",
               code: "SM"
           },
           {
               name: "Sao Tome and Principe",
               code: "ST"
           },
           {
               name: "Saudi Arabia",
               code: "SA"
           },
           {
               name: "Senegal",
               code: "SN"
           },
           {
               name: "Serbia",
               code: "RS"
           },
           {
               name: "Seychelles",
               code: "SC"
           },
           {
               name: "Sierra Leone",
               code: "SL"
           },
           {
               name: "Singapore",
               code: "SG"
           },
           {
               name: "Slovakia",
               code: "SK"
           },
           {
               name: "Slovenia",
               code: "SI"
           },
           {
               name: "Solomon Islands",
               code: "SB"
           },
           {
               name: "Somalia",
               code: "SO"
           },
           {
               name: "South Africa",
               code: "ZA"
           },
           {
               name: "Spain",
               code: "ES"
           },
           {
               name: "Sri Lanka",
               code: "LK"
           },
           {
               name: "Sudan",
               code: "SD"
           },
           {
               name: "South Sudan",
               code: "SS"
           },
           {
               name: "Suriname",
               code: "SR"
           },
           {
               name: "Sweden",
               code: "SE"
           },
           {
               name: "Switzerland",
               code: "CH"
           },
           {
               name: "Syria",
               code: "SY"
           },
           {
               name: "Taiwan",
               code: "TW"
           },
           {
               name: "Tajikistan",
               code: "TJ"
           },
           {
               name: "Tanzania",
               code: "TZ"
           },
           {
               name: "Thailand",
               code: "TH"
           },
           {
               name: "Timor-Leste",
               code: "TL"
           },
           {
               name: "Togo",
               code: "TG"
           },
           {
               name: "Tonga",
               code: "TO"
           },
           {
               name: "Trinidad and Tobago",
               code: "TT"
           },
           {
               name: "Tunisia",
               code: "TN"
           },
           {
               name: "Turkey",
               code: "TR"
           },
           {
               name: "Turkmenistan",
               code: "TM"
           },
           {
               name: "Tuvalu",
               code: "TV"
           },
           {
               name: "Uganda",
               code: "UG"
           },
           {
               name: "Ukraine",
               code: "UA"
           },
           {
               name: "United Arab Emirates",
               code: "AE"
           },
           {
               name: "United Kingdom",
               code: "GB"
           },
           {
               name: "United States",
               code: "US"
           },
           {
               name: "Uruguay",
               code: "UY"
           },
           {
               name: "Uzbekistan",
               code: "UZ"
           },
           {
               name: "Vanuatu",
               code: "VU"
           },
           {
               name: "Vatican City",
               code: "VA"
           },
           {
               name: "Venezuela",
               code: "VE"
           },
           {
               name: "Vietnam",
               code: "VN"
           },
           {
               name: "Yemen",
               code: "YE"
           },
           {
               name: "Zambia",
               code: "ZM"
           },
           {
               name: "Zimbabwe",
               code: "ZW"
           },
       ];

       // Function to get country code by country name
       function getCountryCodeFromText(text) {
           const formattedText = text.toLowerCase(); // Convert the input text to lowercase for comparison
           const country = countries.find(c => formattedText.includes(c.name.toLowerCase()));
           return country ? country.code : "Country not found";
       }

    // Select all inputs with .inp-field, .inp-field-date, and .room classes
    document.querySelectorAll('.inp-field, .inp-field-date, .room').forEach(input => {
    const placeholder = input.nextElementSibling; // Assuming .placeholder is the next sibling

    // Function to update placeholder position on focus or input
    const updatePlaceholderPosition = () => {
        if (input.value.trim() === "" && !input.matches(':focus')) {
    
        } else {
            placeholder.style.top = "-0.1rem";
            placeholder.style.left = "2rem";
            placeholder.style.backgroundColor = "rgba(255, 255, 255, 0.9)";
            placeholder.style.padding = "0 0.25rem";
        }
    };

    // Initial state check
    updatePlaceholderPosition();

    // Event listeners for input and focus/blur events
    input.addEventListener('focus', updatePlaceholderPosition);
    input.addEventListener('blur', updatePlaceholderPosition);
    input.addEventListener('input', updatePlaceholderPosition);
});


// Select all elements with the class "elementor-heading-title"
document.querySelectorAll('.elementor-heading-title').forEach(element => {
    if (element.innerHTML.trim() === 'Explore') {
        // Target the outer div
        const outerDiv = element.closest('div'); // Finds the closest ancestor <div>

        if (outerDiv) {
            // Toggle a class on the outer div
            outerDiv.classList.toggle('custom-outer-class');

            // Apply margin-top: 150px to the outer div
            outerDiv.style.marginTop = '150px';
        }
    }
});


   </script>


   </body>
</html>
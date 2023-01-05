<style>
    .loading-state {
        position: absolute;
        z-index: 2;
        width: 100%;
        height: 100%;
        background-color: #ffffff14;
        top: 0;
        left: 0;
        transition: 300ms ease-in-out;
        text-align: center;
    }

    #regForm {
        background-color: #ffffff;
        margin: 0px auto;
        padding: 40px;
        border-radius: 10px
    }

    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        border: 1px solid #aaaaaa
    }

    input.invalid {
        background-color: #ffdddd
    }

    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5
    }

    .step.active {
        opacity: 1;
        border: 1px solid white;
        transition: 500ms ease-in-out;
    }

    .step.finish {
        background-color: #4CAF50
    }

    .all-steps {
        text-align: center;
    }

    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }


    /* Hide the browser's default radio button */

    .container input[type="radio"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }


    /* Create a custom radio button */

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
    }


    /* On mouse-over, add a grey background color */

    .container:hover input~.checkmark {
        background-color: #ccc;
    }


    /* When the radio button is checked, add a blue background */

    .container input:checked~.checkmark {
        background-color: #2196F3;
    }


    /* Create the indicator (the dot/circle - hidden when not checked) */

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }


    /* Show the indicator (dot/circle) when checked */

    .container input:checked~.checkmark:after {
        display: block;
    }


    /* Style the indicator (dot/circle) */

    .container .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }

    .choice-radio input[type=radio] {
        display: none;
    }

    .choice-radio input[type=radio]:checked+.box {
        background-color: #435ebe;
    }

    /* if .choice-radio input[type=radio]:active dont change background-color on .choice-radio input[type=radio]:hover+.box */
    .choice-radio input[type=radio]:not(:checked):hover+.box {
        background-color: #e6edf9;
    }

    .theme-dark .choice-radio input[type=radio]:not(:checked):hover+.box {
        background-color: #2e2e42;
    }

    .choice-radio input[type=radio]:checked+.box span {
        color: white;
        transform: translateY(70px);
    }

    .choice-radio input[type=radio]:checked+.box span:before {
        transform: translateY(0px);
        opacity: 1;
    }

    .choice-radio .box {
        width: 200px;
        height: 200px;
        background-color: #f2f7ff;
        transition: all 250ms ease;
        will-change: transition;
        display: inline-block;
        text-align: center;
        cursor: pointer;
        position: relative;
        font-family: "Inter", sans-serif;
        font-weight: 900;
        border-radius: 10px;
        margin: 0 5px;
    }

    .theme-dark .choice-radio .box {
        background-color: #2e2e4291;
    }

    .choice-radio .box:active {
        transform: translateY(10px);
    }

    .choice-radio .box span {
        position: absolute;
        transform: translate(0, 40px);
        left: 0;
        right: 0;
        transition: all 300ms ease;
        font-size: 1.5em;
        user-select: none;
        color: #435ebe;
    }

    .choice-radio .box span:before {
        font-size: 1.2em;
        font-family: "bootstrap-icons";
        display: block;
        transform: translateY(-80px);
        opacity: 0;
        transition: all 300ms ease-in-out;
        font-weight: normal;
        color: white;
    }

    .choice-radio .yes-box span:before {
        content: "\f89e";
    }

    .choice-radio .no-box span:before {
        content: "\f4Da";
    }

    .gooey {
        position: absolute;
        width: 142px;
        height: 40px;
        margin: -20px 0 0 -71px;
        filter: contrast(20);
    }

    .gooey .dot {
        position: absolute;
        width: 16px;
        height: 16px;
        top: 12px;
        left: 15px;
        filter: blur(4px);
        background: #000;
        border-radius: 50%;
        transform: translateX(0);
        animation: dot 2.8s infinite;
    }

    .gooey .dots {
        transform: translateX(0);
        margin-top: 12px;
        margin-left: 31px;
        animation: dots 2.8s infinite;
    }

    .gooey .dots span {
        display: block;
        float: left;
        width: 16px;
        height: 16px;
        margin-left: 16px;
        filter: blur(4px);
        background: #000;
        border-radius: 50%;
    }

    @-moz-keyframes dot {
        50% {
            transform: translateX(96px);
        }
    }

    @-webkit-keyframes dot {
        50% {
            transform: translateX(96px);
        }
    }

    @-o-keyframes dot {
        50% {
            transform: translateX(96px);
        }
    }

    @keyframes dot {
        50% {
            transform: translateX(96px);
        }
    }

    @-moz-keyframes dots {
        50% {
            transform: translateX(-31px);
        }
    }

    @-webkit-keyframes dots {
        50% {
            transform: translateX(-31px);
        }
    }

    @-o-keyframes dots {
        50% {
            transform: translateX(-31px);
        }
    }

    @keyframes dots {
        50% {
            transform: translateX(-31px);
        }
    }
</style>

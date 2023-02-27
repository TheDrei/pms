<style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            .bold{
                font-weight:bold;
            }
            body {
                margin : 15px 15px 20px 15px;
                font-family: "Arial", Times, serif;
                font-size: 14px;
            }
            section {
                padding: 1em 0;
            }

            .table-headers {
               font-size: 13px;
            }

            .container {
                max-width: 816px;
                margin: auto;
            }

            .flex-container {
                display: flex;
            }

            .border-bottom-1 {
                border-bottom: 1px solid black;
            }

            .border-black-1 {
                border: 1px solid black;
            }
            .border-top-black-1 {
                border-top: 1px solid black;
            }
            .flex-container .flex-grow-1 {
                flex-grow: 1;
            }
            .text-center {
                text-align : center;
            }
            .text-left {
                text-align: left;
            }
            .text-upper {
                text-transform : uppercase;
            }
            .text-underline {
                text-decoration: underline;
            }
            .font-weight-bold {
                font-weight : bold;
            }
            .header-row {
                margin: 0.5em 0;
            }
            .remarks-row {
                padding: 0.3em 0;
            }
            .par-title {
                font-size: 14px;
            }
            .par-content {
                padding: 1em 0;
                border-bottom:none;
            }
            p {
                padding: 0.4em 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table tr td,
            table tr th {
                border: 1px solid black;
                text-align: center;
                padding-right: 1em;
                padding-left: 1em;
            }

            table tr td {
                padding: 1.5em;
            }
            .property-remarks {
                padding: 1em 0 1em 1em;
              
            }
            .remarks-details {
                padding-left: 7em;
            }

            .signatories > div {
                border-right:none;
                flex: 0 0 50%;
            }
            .signatory-info {
                font-size:11px;
                text-align: center;
                padding: 1em 0;
            }
            .signatory-container {
                padding: 0.5em 1em;
                
            }
        </style>


<span class="bold"> {{$title}}</span><br/>
<span class="bold">Department/Bureau/Office:</span> {{$pcaarrd_title}}<br/>
<span class="bold">Region:</span> {{$region}}<br/>
<span class="bold">Division:</span> {{$division}}<br/>
<span class="bold">Charging:</span> {{$charging}}<br/>

<span class="bold">Data:</span> {{$data}}<br/>
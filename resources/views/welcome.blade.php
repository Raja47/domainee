<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lead Manager</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/main.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/fontawesome-free/css/all.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('/backend/css/sb-admin-2.min.css') }}" />
        <link rel="shortcut icon" href="{{  asset('storage/'.config('settings.site_favicon') ) }}" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
        <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
               
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            
            body.leadManager-kk #sampleTable td {
              text-align: left;
             }
             body.leadManager-kk table.dataTable.no-footer{
                     border-bottom: 0px solid #111;
             }
             body.leadManager-kk table#sampleTable th {
                  border-bottom: 0px solid white;
           }
           body.leadManager-kk table#sampleTable tbody tr td:nth-child(3) {
           
            max-width: 100% !IMPORTANT;
            width: 33% !IMPORTANT;}
          /*.table#sampleTable tr th:before ,*/
          /* .table#sampleTable tr th:after{*/
          /*      display: none;*/
          /* }*/
           
           .table#sampleTable thead .sorting ,
           .table#sampleTable thead .sorting_asc ,
           .table#sampleTable thead .sorting_desc{
                
                background-image: none;
            }
            
            body.leadManager-kk {
                background: linear-gradient(to right,#b92b27,#1565c0);
                overflow-x: hidden;
                max-width: 100%;
                width: 100%;
            }
            body.leadManager-kk .content{
                 background: linear-gradient(to right,#b92b27,#1565c0);
            }
            body.leadManager-kk .m-b-md {
                margin-bottom: 30px;
                color: white;
                font-weight: 900;
                padding-top: 20px;
                    padding-bottom: 2px;
            }
            
            body.leadManager-kk #sampleTable_paginate .pagination .paginate_button:hover {
                    background: transparent !IMPORTANT;
                       border: 1px solid white !IMPORTANT;
            }
            body.leadManager-kk .table#sampleTable thead {
                      background: #1a63bb;
                 }
                 
            body.leadManager-kk table#sampleTable th {
                border-bottom: 0px solid white;
                border-top: 0;
                color: white;
            }
            body.leadManager-kk .top-right.links {
               display: none;
           }
           .table-content-custom{
               margin:1%;
           }
           
        </style>
    </head>
    <body class="leadManager-kk">
        <div class="position-ref full-height">
            @if (Route::has('admin.login'))
                <div class="top-right links">
                    @auth('admin')
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('admin.login') }}">Admin Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md h2">
                    {{config('app.name')}}
                </div>

                <div class="row table-content-custom">
                    
                    <div class="col-md-12">
                        <div class="tile">
                            <div class="tile-body table-responsive">
                                <table class="table table-hover table-striped table-bordered table-sm" id="sampleTable">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th class="th-sm"> Tittle </th>
                                        <th class="th-lg"> Description </th>
                                        <th class="th-sm"> Email </th>
                                        <th class="th-sm"> Phone num </th>
                                        <th class="th-sm"> Category </th>
                                        <th class="th-sm"> Country </th>
                                        <th class="th-sm"> Date Created </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count=1 ;?>
                                        @foreach($leads as $lead)
                                            
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td >{{ $lead->title }}</td>
                                                <td >{!! $lead->description !!}</td>
                                                <td>{{ $lead->email }}</td>
                                                <td>{{ $lead->phone_num }}</td>
                                                <td>{{ optional($lead->category)->title}}</td>
                                                <td>{{ $lead->country }}</td>
                                                <td>{{ $lead->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('/backend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/backend/js/popper.min.js') }}"></script>
    <script src="{{ asset('/backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/backend/js/main.js') }}"></script>
    <script src="{{ asset('/backend/js/plugins/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable({
           "pageLength": 50,
            "columnDefs": [ 
        
            {
             "targets":2,    
            "data": "description",
            "render": function ( data, type, row, meta ) {
              return  type=="display" && data.length > 120 ?
                '<span title="'+data+'" class="desc">'+data.substr( 0, 118 )+' ...</span>' :
                data;
            },
                
                
            }]
        });
        
        $('.desc').on('click', function (value){
             $(this).html( $(this).attr('title') ) ;  
        })
        
    </script>
    
</html>

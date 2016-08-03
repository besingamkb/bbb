<!doctype html>
<html ng-app="app" ng-strict-di>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{!! elixir('css/vendor.css') !!}">
    <link rel="stylesheet" href="{!! elixir('css/app.css') !!}">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
    <title>Laravel Angular Material Starter</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!--[if lte IE 10]>
    <script type="text/javascript">document.location.href = '/unsupported-browser'</script>
    <![endif]-->
    <!-- <script src="https://use.fontawesome.com/86800e93d8.js"></script> -->
</head>
<body>
    <div >
        <div class="project-milestone-main-container" >
            <h1>Project's Milestones</h1>
            <div class="pivot-wrapper">
                <div class="release-wrapper vertical" >
                    <div class="box empty">

                    </div>
                    <!-- <div class="box release-date"  ng-repeat="(release, pm) in project_milestones">
                        <h5>W/C @{{ releaseDateFormat(release) }}</h5>
                    </div> -->
                    @foreach($project_milestones as $release => $pm)
                        <div class="box release-date" >
                        <h5>W/C {{$release}}</h5>
                    </div>
                    @endforeach
                </div>
                <div class="project-milestone-wrapper">
                    @foreach ($all_projects as $project_key => $project_data)
                        <div class="project-milestone vertical" >
                            <div class="box project-name">
                                <h5>{{ $project_data['project_name'] }}</h5>
                            </div>
                            <div class="dragular-milestones">
                                @foreach($project_milestones as $release => $pm)
                                <div class="box milestone">
                                    <div></div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="clear-float"></div>
            </div>
        </div>
    </div>

    

</body>
</html>

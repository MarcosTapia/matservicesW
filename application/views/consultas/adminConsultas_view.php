<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php if ($nombre_Empresa != "") { echo $nombre_Empresa; }?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="distributor" content="Global" />
    <meta itemprop="contentRating" content="General" />
    <meta name="robots" content="All" />
    <meta name="revisit-after" content="7 days" />
    <meta name="description" content="The source of truly unique and awesome jquery plugins." />
    <meta name="keywords" content="slider, carousel, responsive, swipe, one to one movement, touch devices, jquery, plugin, bootstrap compatible, html5, css3" />
    <meta name="author" content="w3widgets.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Economica' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
  
    <style type="text/css" title="currentStyle">
            @import "<?php echo base_url();?>media/css/demo_page.css";
            @import "<?php echo base_url();?>media/css/demo_table.css";
    </style>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>media/js/jquery.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
                $('#example').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );
        $(document).ready(function() {
                $('#example2').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );
        $(document).ready(function() {
                $('#tblSucursal').dataTable( {
                        "sPaginationType": "full_numbers"
                } );
        } );
            
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3" style="border: 1px solid #FFF;border-color: red">
            <div class="span3">
                <div class="well">
                    <div>
                        <ul class="nav nav-list">
                            <li><label class="tree-toggle nav-header">Bootstrap</label>
                                <ul class="nav nav-list tree">
                                    <li><a href="#">JavaScript</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><label class="tree-toggle nav-header">Buttons</label>
                                        <ul class="nav nav-list tree">
                                            <li><a href="#">Colors</a></li>
                                            <li><a href="#">Sizes</a></li>
                                            <li><label class="tree-toggle nav-header">Forms</label>
                                                <ul class="nav nav-list tree">
                                                    <li><a href="#">Horizontal</a></li>
                                                    <li><a href="#">Vertical</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> <!-- primera opcion -->
                            
                            <li class="divider"></li>
                            <li><label class="tree-toggle nav-header">Responsive</label>
                                <ul class="nav nav-list tree">
                                    <li><a href="#">Overview</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><label class="tree-toggle nav-header">Media Queries</label>
                                        <ul class="nav nav-list tree">
                                            <li><a href="#">Text</a></li>
                                            <li><a href="#">Images</a></li>
                                            <li><label class="tree-toggle nav-header">Mobile Devices</label>
                                                <ul class="nav nav-list tree">
                                                    <li><a href="#">iPhone</a></li>
                                                    <li><a href="#">Samsung</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><label class="tree-toggle nav-header">Coding</label>
                                        <ul class="nav nav-list tree">
                                            <li><a href="#">JavaScript</a></li>
                                            <li><a href="#">jQuery</a></li>
                                            <li><label class="tree-toggle nav-header">HTML DOM</label>
                                                <ul class="nav nav-list tree">
                                                    <li><a href="#">DOM Elements</a></li>
                                                    <li><a href="#">Recursive</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul> <!-- menu principal -->
                    </div> <!-- div de menu vertical -->
                </div> <!-- div well -->
            </div> <!-- div span3 -->
        </div> 
        <div class="col-md-9" style="border: 1px solid #FFF;border-color: red">
            <div>
                <?php echo CONSTPRUEBA; ?>
            </div>
            <div>
                <br><br>
            </div>
        </div>
    </div> <!-- / renglon-->
</div> <!-- /container -->

<script>
    $('.tree-toggle').click(function () {
            $(this).parent().children('ul.tree').toggle(200);
    });
    $(function(){
    $('.tree-toggle').parent().children('ul.tree').toggle(200);
    })            
</script>


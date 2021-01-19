{include file='header.tpl'}
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    {include file='navbar.tpl'}
    {include file='sidebar.tpl'}

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{$DASHBOARD}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card card-default">
                            <div class="card-body">
                                <a href="?action=NamelessMC">Action 1 </a>, <a href="?action=Cuberico">Action 2 </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card card-default">
                            <div class="card-body">
                                {$EXAMPLE_CONTENTXD}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    {include file='footer.tpl'}

</div>
<!-- ./wrapper -->

{include file='scripts.tpl'}



</body>
</html>

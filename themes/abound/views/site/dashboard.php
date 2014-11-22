<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Landdisputes::count1(); ?></div>
                                    <div><?php echo Yii::t('app','Landdisputes'); ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='/landdisputes/my'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Landdisputes::count1(true); ?></div>
                                    <div>Urgent <?php echo Yii::t('app','Landdisputes'); ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='/landdisputes/my?p=1'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Complaints::count1();?></div>
                                    <div><?php echo Yii::t('app','Complaints');?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='/complaints/my'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Complaints::count1(true);?></div>
                                    <div>Urgent <?php echo Yii::t('app','Complaints');?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='/landdisputes/my?p=1'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Landdisputes::count1(false,true); ?></div>
                                    <div>Disposed <?php echo Yii::t('app','Landdisputes'); ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='/landdisputes/my?s=1'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Landdisputes::count1(true,true); ?></div>
                                    <div>Disposed Urgent <?php echo Yii::t('app','Landdisputes'); ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='/landdisputes/my?p=1&s=1'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Complaints::count1();?></div>
                                    <div>Disposed <?php echo Yii::t('app','Complaints');?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='/landdisputes/my?s=1'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-files-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Complaints::model()->countByAttributes(array('status'=>1,'priority'=>1));?></div>
                                    <div>Disposed Urgent <?php echo Yii::t('app','Complaints');?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <a href='/complaints/my?p=1&s=1'><span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
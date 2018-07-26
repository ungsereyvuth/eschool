<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6 center-xs">
                <p>
                    <?=enNum_khNum(date("Y"))?> &copy; រាក្សាសិទ្ធគ្រប់យ៉ាង
                </p>
            </div>

            <!-- Social Links -->
            <div class="col-md-6 ">
                <ul class="footer-socials list-inline center-xs">
                    <li>
                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Skype">
                            <i class="fa fa-skype"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest">
                            <i class="fa fa-pinterest"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dribbble">
                            <i class="fa fa-dribbble"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Social Links -->
        </div>
    </div>
</div><!--/copyright-->

<div>
    <!-- Button trigger modal -->
    <div id="yesno_btn" data-toggle="modal" data-target="#yesno_modal"></div>
    <!-- Modal -->
    <div class="modal fade" id="yesno_modal" tabindex="-1" role="dialog" aria-labelledby="yesno_modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="yesno_modalLabel"></h4>
                </div>
                <div class="modal-body khmerNormal" id="yesno_modalLabelBodyText"></div>
                <div class="modal-footer">
                    <div style="float:left;">
                        <div id="yesno_msg"></div>
                    </div>
                    <div style=" float:right;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="yesno_modalCloseBtn">Close</button>
                    <button type="button" class="btn btn-primary" id="yesno_actionBtn"></button>
                    <input type="hidden" id="yesno_confirmData" value="" />
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
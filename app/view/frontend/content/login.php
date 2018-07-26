<div class="container content-sm">
<div class="log-reg-v3">
        <div class="row">
            <div class="col-md-5">
            	<form id="login" method="post" class="ajaxfrm form-horizontal log-reg-block bg-white" role="form">
                    <h2 class="khmerNormal"><?=$pageData->label->label->login->title?></h2>

                    <section>
                    	<div id="login_msg" data-loadtxt='<?=$pageData->label->label->processing->icon.' '.$pageData->label->label->processing->title?>'></div>
                    </section>
                    <section>
                        <label class="input login-input">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" placeholder="<?=$pageData->label->label->username->title?>" id="email" class="form-control">
                            </div>
                        </label>
                    </section>
                    <section>
                        <label class="input login-input no-border-top">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" placeholder="<?=$pageData->label->label->password->title?>" id="password" class="form-control">
                            </div>
                        </label>
                    </section>
                    <div class=" margin-bottom-5">
                        <div class="clearfix">
                            <div class="col-xs-6">
                                <label class=" v_pad0">
                                    <input type="checkbox" name="checkbox"/>
                                    <i></i>
                                    Remember me
                                </label>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="/<?=$pageData->lang->selected.$pageData->label->label->account_resetpwd->url?>"><?=$pageData->label->label->forget_pwd->icon.' '.$pageData->label->label->forget_pwd->title?></a>
                            </div>
                        </div>
                    </div>
                    <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit"><?=$pageData->label->label->login->title?></button>
                </form>

                <div class="margin-bottom-20"></div>
                <p class="text-center">Don't have account yet? <a href="/<?=$pageData->lang->selected.$pageData->label->label->register->url?>"><?=$pageData->label->label->register->title?></a></p>
            </div>
            <div class="col-md-7">
                <div class="tag-box tag-box-v2 box-shadow shadow-effect-1 bg-white">
                    <h3 style="font-weight: 300;"><span style="color: #ff9900;">សូមស្វាគមន៍ ចូលមកកាន់</span> <strong><span><?=$pageData->label->system_title->sys->title?></span></strong></h3>
                    <p class="v_pad10">ប្រព័ន្ធអាជ្ញាបណ្ណទេសចរណ៍អនឡាញបានបញ្ជូនតម្លាភាព និង កាត់បន្ថយពេល វេលានៃការស្នើសុំរបស់ប្រតិបត្តិករ អោយមានភាពឆាប់រហ័សក្នុងដំណើរការនៃការស្នើ សុំ។</p>
                    <p><strong>សម្រាប់ព័ត៌មានលំអិតសូមទំនាក់ទំនង៖</strong></p>
                    <p>ទូរស័ព្ទ/Tel.<span>៖(+៨៥៥) ១២ ៩៩៩ ០៣១</span></p>
                    <p>អ៊ីម៉ែល/Email<span>៖</span> <a href="mailto:info@cambodiatourismindustry.org">info@cambodiatourismindustry.org</a></p>
                    <p>គេហទំព័រ/Web<span>៖</span> <a href="http://www.cambodiatourismindustry.org/">www.cambodiatourismindustry.org</a></p>
                </div>
            </div>
        </div><!--/end row-->
</div>
<!--=== End Login ===-->
</div>
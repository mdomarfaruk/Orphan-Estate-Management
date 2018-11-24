<aside id="left-panel">
<?php
    $segment1 =  Request::segment(1);
    $segment2 =  Request::segment(2);
    $combine_segment=$segment1."/".$segment2
?>


<!-- User info -->
    <div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it -->

					<a href="javascript:void(0);" id="show-shortcut" >
						<img src=" <?php  echo asset('fontView/assets/img/avatars/sunny.png');?>" alt="me" class="online" />
						<span>
							{{ (!empty(Auth::user()->name)?Auth::user()->name:NULL) }}
						</span>
					</a>

				</span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>
        <ul>
            <li class="active">
                <a href="<?php  echo asset('/home');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">ডেসবোর্ড</span></a>
            </li>

            <li  >
                <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">ক্যাশ রিসিপট</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['get_donation_box_receipt','get_money_receipt_donar','get_money_receipt_bank'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/get_donation_box_receipt');?>">দান বাক্স আদায়</a>
                    </li>
                    <li >
                        <a href="<?php  echo asset('/get_money_receipt_donar');?>">মানি রিসিপট (ডোনার)</a>
                    </li>
                    <li>
                        <a href="<?php  echo asset('/get_money_receipt_bank');?>">ব্যাংক হতে রিসিপট</a>
                    </li>

                </ul>
            </li>
            <li >
                <a href="#"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">ক্যাশ প্রদান</span></a>
                <ul>

                    <li <?php if(in_array($segment1,['get_payment_cash','get_payment_bank'])){ echo 'class="active"';} ?>>
                        <a href="<?php  echo asset('/get_payment_cash');?>">ক্যাশ হতে প্রদান</a>
                    </li>
                    <li>
                        <a href="<?php  echo asset('/get_payment_bank');?>">ব্যাংক হতে প্রদান</a>
                    </li>

                </ul>
            </li>


            <li>
                <a href="<?php  echo asset('/add_eatim_information');?>"><i class="fa fa-lg fa-fw fa-list-alt"></i><span class="menu-item-parent">এতিমের তথ্য</span></a>
            </li>
            <li>
                <a href="<?php  echo asset('/staff_info/list');?>"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">কর্মচারীর তথ্য</span></a>
            </li>
            <li>
                <a href="<?php  echo asset('/bank_info/list');?>"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">ব্যাংকের তথ্য</span></a>
            </li>
            <li>
                <a href="<?php  echo asset('/donar/list');?>"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">ডোনারের তথ্য</span></a>
            </li>
            <li>
                <a href="<?php  echo asset('/donation_box/list');?>"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent"></span>দান বাক্স</a>
            </li>



            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-puzzle-piece"></i> <span class="menu-item-parent">রিপোর্ট</span></a>
                <ul>
                    <li <?php if(in_array($segment1,['get_all_expense_report','get_all_collection_report'])){ echo 'class="active"';} ?>>
                        <a href="<?php echo asset('/get_all_expense_report') ?>">প্রদানের রিপোর্ট</a>
                    </li>
                    <li>
                        <a href="<?php echo asset('/get_all_collection_report') ?>">কালেকশন রিপোর্ট</a>
                    </li>

                    {{--<li>--}}
                        {{--<a href=#"> মাসিক আয়ের-ব্যয়ের হিসাব</a>--}}
                    {{--</li>--}}

                    {{--<li>--}}
                        {{--<a href="#">ব্যলেনস সীট</a>--}}
                    {{--</li>--}}

                </ul>
            </li>

            <li>
                <a href="#"><i class="fa fa-lg fa-fw fa-windows"></i> <span class="menu-item-parent" <?php if(in_array($combine_segment,['designation/List','department/list','user_role/list'])){ echo 'class="active"';} ?>>সেটংস</span></a>
                <ul>
                    <li <?php if(in_array($combine_segment,['designation/List','department/list','user_role/list','get_montly_open/'])){ echo 'class="active"';} ?> >
                        <a href="<?php  echo asset('/designation/List');?>">ডেজিগেনেশন</a>
                    </li>
                    <li>
                        <a href="<?php  echo asset('/department/list');?>">ডিপার্টমেন্ট</a>
                    </li>
                    <li>
                        <a href="<?php  echo asset('/get_montly_open');?>">নতুন মাস এন্টি</a>
                    </li>
                    <li>
                        <a href="<?php  echo asset('/user_role/list');?>">এক্সেস</a>
                    </li>


                    {{--<li>--}}
                        {{--<a href="{{ route('register') }}">User Create</a>--}}
                    {{--</li>--}}

                </ul>
            </li>

        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>


@extends('layouts.site')
@section('title','Liên hệ')
@section('content')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<main>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="index1.html">Trang chủ<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="blog-single.html">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="form-main">
                            <div class="title">
                                <h4>Liên lạc</h4>
                                <h3>Viết thông báo</h3>
                            </div>
                            <form class="form" method="post" action="mail/mail.php">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Tên của bạn<span>*</span></label>
                                            <input name="name" type="text" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Chủ đề của bạn<span>*</span></label>
                                            <input name="subject" type="text" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Email của bạn<span>*</span></label>
                                            <input name="email" type="email" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Số điện thoại<span>*</span></label>
                                            <input name="company_name" type="text" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group message">
                                            <label>Tin nhắn của bạn<span>*</span></label>
                                            <textarea name="message" placeholder=""></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group button">
                                            <button type="submit" class="btn ">Nhắn tin</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-head">
                            <div class="single-info">
                                <i class="fa fa-phone"></i>
                                <h4 class="title">Gọi chúng tôi:</h4>
                                <ul>
                                    <li>+123 456-789-1120</li>
                                    <li>+522 672-452-1120</li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="fa fa-envelope-open"></i>
                                <h4 class="title">Email:</h4>
                                <ul>
                                    <li><a href="mailto:info@yourwebsite.com">kuteshop@gmail.com</a></li>
                                    <li><a href="mailto:info@yourwebsite.com">kuteshop@gmail.com</a></li>
                                </ul>
                            </div>
                            <div class="single-info">
                                <i class="fa fa-location-arrow"></i>
                                <h4 class="title">Địa chỉ:</h4>
                                <ul>
                                    <li>Hẻm 200. Dương Đình Hội - Phước Long B.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact -->

    <!-- Map Section -->
    <div class="map-section">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.746776096375!2d106.77242407493361!3d10.83068048932141!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752701a34a5d5f%3A0x30056b2fdf668565!2sHo%20Chi%20Minh%20City%20College%20of%20Industry%20and%20Trade!5e0!3m2!1sen!2s!4v1716221180307!5m2!1sen!2s" width="600" height="450" style="border:2;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!--/ End Map Section -->

<x-newsletter/>
</main>
@endsection

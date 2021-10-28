@extends('website.master')
@section('main')
<section class="about-section">
    <div class="about-container">
        <div class="left-cont">
            <div class="line3">
                <img src="/website/img/line3.png" alt="line">
            </div>
        </div>
        <div class="right-cont">
            <div class="child-img">
                <img src="/website/img/Path 539.png" alt="">
            </div>
            <div class="child-img2">
                <img src="/website/img/Path 541.png" alt="">
            </div>
        </div>
    </div>
    <div class="position-container">
        <div class="container">
            <div class="row">
                <a href="#" class="about-left">
                    <div class="about-text">
                        <h2>ABOUT GELAB</h2>
                        <div class="about-article">
                            <p>
                                It is a long established fact that a reader will be distracted by the readable
                                content of a page when looking at its layout. The point of using Lorem Ipsum is
                                that it has a more-or-less normal distribution of letters, as opposed to using
                                'Content here. The point of using Lorem Ipsum is that it has a more-or-less normal
                                distribution of letters, as opposed to using 'Content here...
                            </p>
                            <div class="arrow">
                                <span class="icon-arrow"></span>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="about-right">
                    <div class="about-text2">
                        <h2>GEORGIAN LABORATORIES</h2>
                        <div class="about-article2">
                            <p>
                                It is a long established fact that a reader will be distracted by the
                                readable content of a page when looking at its layout. The point of
                                using Lorem Ipsum is that it has a more-or-less normal distribution of
                            </p>
                            <div class="arrow">
                                <span class="icon-arrow icon-arrow2"></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="fix-social">
        <a href="#">
            <span class="icon-face"></span>
        </a>
        <a href="#">
            <span class="icon-in"></span>
        </a>
    </div>
</section>

<section class="trainings-section">
    <div class="trainings-boxes1">
        <div class="tr-box-left">
            <div class="tr-img-box">
                <img src="/website/img/left-bg.jpg" alt="img">
                <div class="tr-bg"></div>
            </div>
        </div>
        <div class="tr-box-right">
            <div class="tr-img-box2">
                <img src="/website/img/arrangement-with-microscope-tubes.png" alt="img">
                <div class="tr-bg2"></div>
                <div class="bg-rect"></div>
            </div>
        </div>
    </div>
    <div class="trainings-boxes2">
        <div class="container">
            <div class="row">
                <div class="trainings-text-box">
                    <div class="tr-text">
                        <h2>TRAININGS</h2>
                        <div class="tr-article">
                            <p>
                                It is a long established fact that a reader will be
                                distracted by the readable content of a page when
                                looking at its layout. The point of using Lorem Ipsum is
                                that it has a more-or-less normal distribution of letters,
                                as opposed to using 'Content here. The point of using
                            </p>
                            <div class="tr-arrow">
                                <span class="icon-arrow"></span>
                            </div>
                        </div>
                    </div>
                    <div class="tr-text2">
                        <div class="other-services">
                            <h2>OTHER SERVICES</h2>
                            <div class="services-list">
                                <a class="services-link" href="#"><span>Organizing PT/ILCs</span></a>
                                <a class="services-link" href="#"><span>Support: Purchasing (chamicals, lab <br> equipment, etc.)</span></a>
                                <a class="services-link" href="#"><span>Recruitment</span></a>
                                <a class="services-link" href="#"><span>Request for individual services</span></a>
                            </div>
                            <div class="trainings-icon2">
                                <span class="icon-arrow float-arrow2"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="events-section">
    <div class="events-boxes1">
        <div class="ev-left-box"></div>
        <div class="ev-right-slider-box">
            <div class="left-arrow" id="left-arrow"><span class="icon-left-arrow"></span></div>
            <div class="right-arrow" id="right-arrow"><span class="icon-left-arrow"></span></div>
            <div class="ev-right-box" >
                <div class="ev-right-img-box">
                    <img src="/website/img/ev-bg.jpg" alt="img">
                    <div class="ev-bg"></div>
                    <div class="events-time">
                        <a href="#">2-5 JUNE, 2021</a>
                        <p>
                            It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout.
                        </p>
                    </div>
                </div>
                <div class="ev-right-img-box">
                    <img src="/website/img/ev-bg.jpg" alt="img">
                    <div class="ev-bg"></div>
                    <div class="events-time">
                        <a href="#">2-5 JUNE, 2021</a>
                        <p>
                            It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout.
                        </p>
                    </div>
                </div>
                <div class="ev-right-img-box">
                    <img src="/website/img/ev-bg.jpg" alt="img">
                    <div class="ev-bg"></div>
                    <div class="events-time">
                        <a href="#">2-5 JUNE, 2021</a>
                        <p>
                            It is a long established fact that a reader will be distracted by the
                            readable content of a page when looking at its layout.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="events-boxes2">
        <div class="container events-cont">
            <div class="row">
                <div class="evennts-text-box">
                    <h2>EVENTS <span class="events-line"></span></h2>
                    <p class="events-text1">
                        It is a long established fact that a reader will be distracted by the readable
                        content of a page when looking at its layout. The point of using Lorem Ipsum is
                        that it has a more-or-less normal distribution of letters, as opposed to using
                    </p>
                    <p class="events-text2">
                        It is a long established fact that a reader will be distracted by the readable
                        content of a page when looking at its layout.
                    </p>
                    <span class="icon-arrow ev-icon-arrow"></span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



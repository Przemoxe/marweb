<?php
/* Template Name: FAQ */
?>

<?php
get_header();
?>

<nav class="single-blog-nav">
    <div class="main-container-px20">
        <nav class="single-blog-nav">
            <div class="container-title">
                <h5>
                    FAQ
                </h5>
            </div>
            <div class="container-links">
                <span class="breadcrumb-item">
                    <a href="<?= get_home_url() ?>">Home</a>
                </span>
                <span class="breadcrumb-item active">
                    <i class="arrow right"></i>
                    <?= get_the_title() ?>
                </span>
            </div>
        </nav>
    </div>
</nav>

<section class="template-faq-section">
    <div class="main-container-px20">
        <div class="template-faq-container">
            <div class="left-navbar">
                <h6 class="title">
                    HELP CENTER
                </h6>
            </div>
            <div class="faq-content">
                <h3>
                    Need help? Browse our <span>FAQs</span>
                </h3>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores tempore omnis non nemo distinctio, perspiciatis ut reprehenderit tenetur eveniet, et doloribus ipsa eligendi incidunt voluptas? Incidunt perferendis reiciendis velit optio corporis, delectus commodi nam ad distinctio, omnis fuga obcaecati consequatur numquam reprehenderit amet necessitatibus eum aspernatur sequi. Accusantium, quo cum.
                </p>

                <div class="accordions-wrapper">
                    <div class="accordion">
                        <div class="accordion-header">
                            <div class="accordion-plus"></div>
                            <h4>Accordion #1</h4>
                        </div>

                        <div class="accordion-body">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet
                                eaque sint distinctio, cupiditate placeat iusto perferendis magnam
                                possimus sapiente! Delectus aspernatur numquam laborum impedit
                                corporis.
                            </p>
                        </div>
                    </div>

                    <div class="accordion">
                        <div class="accordion-header">
                            <div class="accordion-plus"></div>
                            <h4>Accordion #2</h4>
                        </div>

                        <div class="accordion-body">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet
                                eaque sint distinctio, cupiditate placeat iusto perferendis magnam
                                possimus sapiente! Delectus aspernatur numquam laborum impedit
                                corporis.
                            </p>
                        </div>
                    </div>

                    <div class="accordion">
                        <div class="accordion-header">
                            <div class="accordion-plus"></div>
                            <h4>Accordion #3</h4>
                        </div>

                        <div class="accordion-body">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet
                                eaque sint distinctio, cupiditate placeat iusto perferendis magnam
                                possimus sapiente! Delectus aspernatur numquam laborum impedit
                                corporis.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="template-faq-container">
            <div class="left-navbar">
                <h6 class="title">
                    ADDITIONAL RESOURCES
                </h6>
            </div>
            <div class="faq-content">
                <h3>
                    Still confused?
                </h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, explicabo nam fugit aspernatur quaerat est id sequi, molestias dolore laboriosam perferendis officiis provident asperiores. Eveniet vitae cumque at ab dolorem!
                </p>
                <div class="more-info-container">
                    <div class="contact-support">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                            <h5>
                                Contact support
                            </h5>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit deserunt vero pariatur.
                            </p>
                        </div>
                        <a href="">
                        </a>
                    </div>
                    <div class="contact-support">
                        <div class="card-body">
                            <div class="card-icon">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div>
                            <h5>
                                Ask a question
                            </h5>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit deserunt vero pariatur.
                            </p>
                        </div>
                        <a href="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>



<?php
get_footer();
?>
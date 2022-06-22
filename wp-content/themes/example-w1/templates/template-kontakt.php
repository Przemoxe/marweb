<?php
/* Template Name: Kontakt */
?>

<?php
get_header();
?>

<nav class="single-blog-nav">
    <div class="main-container-px20">
        <nav class="single-blog-nav">
            <div class="container-title">
                <h5>
                    Contact
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

<section class="template-contact-section">
    <div class="main-container-px20">
        <div class="template-contact-container">
            <div class="left-navbar">
                <h6 class="title">
                    Our offices
                </h6>
            </div>
            <div class="contact-content">
                <h3>
                    Want to talk <span>in person</span>? Call us or visit us
                </h3>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores tempore omnis non nemo distinctio, perspiciatis ut reprehenderit tenetur eveniet, et doloribus ipsa eligendi incidunt voluptas? Incidunt perferendis reiciendis velit optio corporis, delectus commodi nam ad distinctio, omnis fuga obcaecati consequatur numquam reprehenderit amet necessitatibus eum aspernatur sequi. Accusantium, quo cum.
                </p>
                <div class="content-data">
                    <div class="single-data">
                        <h5>
                            Location:
                        </h5>
                        <p>
                            1234 Altschul, New York, NY 10027-0000
                        </p>
                    </div>
                    <div class="single-data">
                        <h5>
                            Email:
                        </h5>
                        <p>
                            <a href="mailto:admin@domain.com">
                                admin@domain.com
                            </a>
                        </p>
                    </div>
                    <div class="single-data">
                        <h5>
                            Call us:
                        </h5>
                        <p>
                            <a href="tel:1234567890">
                                132-465-78-90
                            </a>
                        </p>
                    </div>
                    <div class="single-data">
                        <h5>
                            Skype:
                        </h5>
                        <p>
                            <a href="tel:1234567890">
                                simpleqode.skype
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

<section class="template-contact-form-section">
    <div class="main-container-px20">
        <div class="template-contact-container">
            <div class="left-navbar">
                <h6 class="title">
                    CONTACT FORM AND INFORMATION
                </h6>
            </div>
            <div class="ask-us-container">
                <div class="contact-content">
                    <h3>
                    Have questions? Send us an <span>e-mail</span>
                    </h3>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores tempore omnis non nemo distinctio, perspiciatis ut reprehenderit tenetur eveniet, et doloribus ipsa eligendi incidunt voluptas? Incidunt perferendis reiciendis velit optio corporis, delectus commodi nam ad distinctio, omnis fuga obcaecati consequatur numquam reprehenderit amet necessitatibus eum aspernatur sequi. Accusantium, quo cum.
                    </p>
                </div>
                <form action="">
                    <div class="form-group-container">
                        <div class="form-group">
                            <label>Name:</label>
                            <div class="input-group">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <input type="text" class="form-control order-1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <div class="input-group">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <input type="text" class="form-control order-1">
                            </div>
                        </div>
                        <div class="form-group form-comments">
                            <label>Comments:</label>
                            <div class="input-group input-group-textarea">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                <textarea type="text" id="autoresizing" class="form-control order-1"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="submit" class="btn-send">
                            Send the message
                        </button>
                    </div>
                </form>
                <p class="call-us">
                    <span class="call-us-text">
                        Or call us:
                    </span>
                    <a href="#">
                        +123-456-78-90
                    </a>
                </p>
            </div>
        </div>
    </div>

</section>



<?php
get_footer();
?>
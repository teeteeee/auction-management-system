 <?php require_once './config.php'; ?>
 <?php include_once './layout/header.php' ?>

<section class="faq-section padding-bottom bodyy">
    <div class="container">            
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mt-5">FAQ</h2>
                <p class="text-center">Do not hesitate to send us an email if you can't find what you're looking for.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="faq-wrapper">
                    <div class="faq-item open active">
                        <div class="question">
                            <img src="<?= ROOT ?>/assets/landing/images/faq.png" alt="css">
                            <span class="text-center">How to start bidding?</span>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>Start Bidding by registering.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="question">
                            <img src="<?= ROOT ?>/assets/landing/images/faq.png" alt="css">
                            <span class="text-center">How to register to bid in an auction?</span>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>Click on the register button and fill the form provided.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="question">
                            <img src="<?= ROOT ?>/assets/landing/images/faq.png" alt="css">
                            <span class="text-center">Delivery time to the destination of the winner </span>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>The time taken to deliver the product to the winner of the bid depends on the location <br> Same city delivery takes 3-4 working days <br> Different city delivery takes 5-7 working days <br>Nationwide deliveries takes 8-12 working days.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="question">
                            <img src="<?= ROOT ?>/assets/landing/images/faq.png" alt="css">
                            <span class="text-center">How will I know if my bid was successful?</span>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>An email would be sent to the winner to notify the winner after the auction closes.</p>
                        </div>
                    </div>                    
                    <div class="faq-item">
                        <div class="question">
                            <img src="<?= ROOT ?>/assets/landing/images/faq.png" alt="css">
                            <span class="text-center">How do I know if I'm the high bidder?</span>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>If the amount you entered is the highest bid you'll see the price at the current price by that you'll know you're the higher bidder.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="question">
                            <img src="<?= ROOT ?>/assets/landing/images/faq.png" alt="css">
                            <span class="text-center">Can I bid using my mobile device?</span>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>Yes a moblile device can be used to participate in an auction.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="question">
                            <img src="<?= ROOT ?>/assets/landing/images/faq.png" alt="css">
                            <span class="text-center">Cancellations and returns</span>
                            <span class="right-icon"></span>
                        </div>
                        <div class="faq-content">
                            <p>Once a bidder wins a bid, it cant be cancelled nor returned.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    this.addEventListener("DOMContentLoaded", () => {
        const questions = document.querySelectorAll(".question");

        questions.forEach((question) => {
            question.addEventListener("click", () => {
                if(question.parentNode.classList.contains("active")){
                    question.parentNode.classList.remove("active");
                    question.parentNode.classList.remove("open");
                } else {
                    questions.forEach(question => {
                        question.parentNode.classList.remove("active");
                        question.parentNode.classList.remove("open");
                    });
                    question.parentNode.classList.add("active");
                    question.parentNode.classList.add("open");
                }
            });
        });
    }) 
</script>

<?php include_once './layout/footer.php'; ?>
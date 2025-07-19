<html>
    <head>
        <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
        <style>
            
            footer {
                background-color: #ffffe7;
                padding: 20px 5%;
                text-align: center;
                border-top: 1px solid #e0e0e0;
                font-family: 'Quicksand','Montserrat';
                
            }

            .footer-content {
                margin: 0;
                padding: 0 20px;
                display: flex;
                justify-content: space-around; 
                align-items: flex-start;
                flex-wrap: wrap;
            }

            

            .footer-content h4 {
                font-size: 18px;
                font-weight: bold;
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .socialmedia {
                text-align: left;
            }

            .socialmedia a {
                margin-right: 10px;
                display: inline-block;
                transition: transform 0.3s ease;
            }

            .socialmedia a:hover {
                transform: scale(1.2);
            }

            .socialmedia img {
                display: block;
                margin: 0 auto;
            }

            .footer-info, .footer-contact {
                text-align: left;
            }

            .footer-info p, .footer-contact p {
                margin: 10px 0;
            }

            .footer-info a, .footer-contact a {
                color: #000;
                text-decoration: none;
                font-size: 14px;
            }

            .footer-info a:hover{
                font-weight: bold;
            } 
            
            .footer-contact a:hover {
                text-decoration: underline;
            }

            .copyright {
                margin-top: 100px;
                font-size: 14px;
                color: #000;
            }

        </style>
    </head>
    <footer>
        <div class="footer-content">
            <div class="socialmedia">
                <h4>Follow Us</h4>
                <a href="https://www.x.com" target="_blank" rel="noopener noreferrer">
                    <img src="./images/twitter.png" alt="Twitter" width="28" height="28">
                </a>
                <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
                    <img src="./images/instagram.png" alt="Instagram" width="30" height="30">
                </a>
                <a href="https://www.whatsapp.com" target="_blank" rel="noopener noreferrer">
                    <img src="./images/whatsapp.png" alt="WhatsApp" width="30" height="30">
                </a>
            </div>
            
            <div class="footer-info">
                <h4>Info</h4>
                <p><a href="faq.php">FAQ</a></p>
                <p><a href="tnc.php">Terms and Condition</a></p>
                <p><a href="privacypolicy.php">Privacy Policy</a></p>
            </div>
            
            <div class="footer-contact">
                <h4>Contact Us</h4>
                <p><a href="mailto:foodrise.co@gmail.com">foodrise.co@gmail.com</a></p>
            </div>
        </div>
        
        <div class="copyright">
            <p>Copyright &copy; 2024 FoodRise Co. </p>
        </div>
        
    </footer>
</html>
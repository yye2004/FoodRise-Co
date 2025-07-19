<?php
include 'mysqli_connect.php';
include 'header.php';
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Money Donation</title>
<link rel="stylesheet" href="style.css">
<style>
    .donation-title {
        font-family:'Lexend Deca' ;
        font-size: 52px;
        font-weight: 900;
        border-bottom: 1px solid #333;
        padding-bottom: 10px;
        margin: 50 200 20 200;
    }
    
    h2 {
        font-family: 'Lexend Deca';
        color: #000;
        margin: 30 0 30 0;
        font-size: 48;
        text-align: center;
    }
    
    .donation-desc p{
        font-family:'Lexend Deca' ;
        font-size: 28px;
        border-bottom: 1px solid #333;
        padding-bottom: 50px;
        margin: 50 200 20 200;
    }
    
    .donation-container{
        display:flex;
        padding-bottom: 10px;
        margin: 50 200 20 200;
        justify-content: space-around;
    }
    
    .donation-container .left, .right{
        width: 70%;
        padding: 0 20 0 20;
        align-items: start;
    }
    
    .donation-container h3{
        font-family:'Lexend Deca' ;
        font-weight: bold;
        font-size: 24px;
        padding: 0 0 0 0;
    }
    
    label {
        font-size: 20px;
    }
    
    input[type="radio"] {
        transform: scale(1.5); /* Adjusts the size of the radio button (1.5x its original size) */
        margin-right: 20px; /* Adds space between the radio button and the label */
    }
    
    .amount{
        margin: 0 0 0 0;
        padding: 10 0 20 0 ;
        display: flex;
        align-items: center;
    }
    
    .payment-method{
        margin-bottom: 60px;
    }
    
    .payment-method-logo{
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
        display: flex;
        flex-direction: column;
        justify-content: center;
        width:100px;
        height:70px;
    }
    
    .left{
        padding: 0 0 0 0;
        margin: 0 0 0 0;
    }
    
    #other-amount {
        border: 0 0 0 0;
        margin: 0 0 0 10;
        font-family: 'Lexend deca';
        font-size: 20px;
        width: 100px; /* Adjust width as needed */
        height: 24px;
        display: none;  /* Initially hidden */
    }
    
    .donor-section {
        border-radius: 0;
        display: flex;
        width: 100%;
        flex-direction: column;
        align-items: center;
        color: #000;
        line-height: 1.3;
    }

    .input-row {
        display: flex;
        align-items: center;
        color: rgba(157, 157, 157, 1);
    }

    select,
    input[type="text"] {
        font-family: 'Lexend deca';
        border-radius: 50px;
        background-color: rgba(255, 255, 255, 1);
        border: 1px solid rgba(0, 0, 0, 0.5);
        padding: 10px 20px;
        margin-right: 10px;
        height: 40px;
        color: #808080;
    }

    .anonymous-container {
        display: flex;
        margin: 10 10 10 10;
    }

    .checkbox-input {
        font-family: 'Lexend deca';
        background-color: #fff;
        display: flex;
        width: 16px;
        height: 16px;
        border: 1px solid rgba(0, 0, 0, 1);
    }

    .anonymous-text {
        font-size: 14px;
        font-style: italic;
    }

    input:disabled {
        background-color: #f0f0f0; /* Light gray background */
        color: #a9a9a9; /* Light gray text */
        cursor: not-allowed; /* Change the cursor to indicate the field is not interactive */
        border: 1px solid #ccc; /* Light border to make it look disabled */
    }

    .disabled-input {
        background-color: #f0f0f0;
        color: #a9a9a9;
        cursor: not-allowed;
        border: 1px solid #ccc;
    }

    .submit-button{
        width:100%;
        display: flex; /* Make the container a flex container */
        justify-content: center; /* Horizontally center the button */
        align-items: center;
    }

    input[type="submit"]{
        font-family: 'Quicksand';
        color: #fff;
        padding: 15px 40px;
        margin-bottom: 50px;
        font-size: 18px;
        background-color: #000;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.5s ease;   
        justify-content: center; /* Horizontally center the button */
    }

    input[type="submit"]:hover{
        background-color: #fff;
        color: #000;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="donation-title">Money Donation</div>

<div class="donation-desc">
    <p>
    Support Us with a Financial Donation.<br /><br />
    Your donation directly helps provide nutritious meals to those in need and sustains our hunger relief programs. Whether it's a one-time contribution or a monthly commitment, every penny makes a difference in the fight against hunger.
    </p>
</div>

<form class="donor-section" action="moneydonation_process.php" method="POST">
    <div class="donation-container">
        <div class="left">
            <h3>Amount (RM):</h3>
            <div class="amount">
                <input type="radio" id="20" name="amount" value="20">
                <label for="20">20.00</label>
            </div>
            <div class="amount">
                <input type="radio" id="50" name="amount" value="50">
                <label for="50">50.00</label>
            </div>
            <div class="amount">
                <input type="radio" id="100" name="amount" value="100">
                <label for="100">100.00</label>
            </div>
            <div class="amount">
                <input type="radio" id="other" name="amount" value="other">
                <label for="100">Other Amount:</label>
                <input type="text" id="other-amount" name="other_amount" />
            </div>
        </div>

        <div class="right">
            <div class="payment-method">
                <h3>Payment Method:</h3>
                <div class="payment-method-logo">
                    <img src="./images/duitnow.png" alt="duitnow" class="payment-icon" />
                </div>
            </div>

            <div class="donor-details">
                <h3>Donor Details:</h3>
                <div class="input-row">
                    <select id="pronouns" name="pronouns" required>
                        <option value="">Select</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="none">none</option>
                    </select>
                    <input type="text" id="donorName" name="donor_name" placeholder="Enter your name" required>
                </div>

                <div class="anonymous-container">
                    <input type="checkbox" id="anonymousCheck" name="anonymous" class="checkbox-input" />
                    <label for="anonymousCheck" class="anonymous-text">I would like to stay anonymous</label>
                </div>
            </div>
        </div>
    </div>

    <div class="submit-button"><input type="submit" value="Donate"></div>
</form>

<script>
document.getElementById('other').addEventListener('change', function() {
    var inputField = document.getElementById('other-amount');
    // Toggle the visibility of the input field
    if (this.checked) {
        inputField.style.display = 'inline-block';  // Show input field
    } else {
        inputField.style.display = 'none';  // Hide input field
    }
});

document.getElementById('anonymousCheck').addEventListener('change', function() {
    var nameInput = document.getElementById('donorName');
    var pronounsSelect = document.getElementById('pronouns');
    // Disable or enable the inputs based on the checkbox state
    if (this.checked) {
        // Clear the values of the input fields
        nameInput.value = '';
        pronounsSelect.value = '';
        // Disable the input and select fields
        nameInput.disabled = true;
        pronounsSelect.disabled = true;
        // Apply disabled style to input and select
        nameInput.classList.add('disabled-input');
        pronounsSelect.classList.add('disabled-input');
    } else {
        // Enable the input and select fields
        nameInput.disabled = false;
        pronounsSelect.disabled = false;
        // Remove disabled style from input and select
        nameInput.classList.remove('disabled-input');
        pronounsSelect.classList.remove('disabled-input');
    }
});
</script>

<?php 
include 'footer.php';
?>

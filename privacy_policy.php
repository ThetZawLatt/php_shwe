
<?php

// Privacy Policy for Lottery App

class LotteryAppPrivacyPolicy {
    
    private $informationCollection = "We may collect personal information including email addresses, phone numbers, and names from users when they register an account or participate in activities within the app.";
    
    private $useOfInformation = "The information collected will be used for purposes such as user account management, communication with users regarding app updates or promotions, and to enhance the user experience within the app.";
    
    private $dataSecurity = "We take appropriate measures to safeguard the personal information collected from unauthorized access, disclosure, alteration, or destruction.";
    
    private $dataSharing = "We do not sell, trade, or otherwise transfer users' personal information to third parties without consent, except for trusted third parties who assist us in operating our app or conducting our business.";
    
    private $consent = "By using our Lottery App, users consent to the collection and use of their personal information as outlined in this Privacy Policy.";
    
    private $updatesToPrivacyPolicy = "We reserve the right to update or make changes to this Privacy Policy. Users will be notified of any changes, and it is recommended to review this policy periodically for updates.";
    
    public function displayPrivacyPolicy() {
        echo "<style>
                .privacy-policy {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    margin: 20px;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #f9f9f9;
                }
                h2 {
                    color: #333;
                    font-size: 24px;
                    text-align: center;
                    margin-bottom: 20px;
                }
                p {
                    color: #555;
                    font-size: 16px;
                }
            </style>";
        
        echo "<div class='privacy-policy'>";
        echo "<h2>Privacy Policy for Lottery App</h2>";
        echo "<p>At our Lottery App, we are committed to protecting the privacy of our users. This Privacy Policy outlines how we collect, use, and safeguard the personal information provided by users such as email, phone number, and name.</p>";
        echo "<p><strong>1. Information Collection:</strong><br>" . $this->informationCollection . "</p>";
        echo "<p><strong>2. Use of Information:</strong><br>" . $this->useOfInformation . "</p>";
        echo "<p><strong>3. Data Security:</strong><br>" . $this->dataSecurity . "</p>";
        echo "<p><strong>4. Data Sharing:</strong><br>" . $this->dataSharing . "</p>";
        echo "<p><strong>5. Consent:</strong><br>" . $this->consent . "</p>";
        echo "<p><strong>6. Updates to Privacy Policy:</strong><br>" . $this->updatesToPrivacyPolicy . "</p>";
        echo "<p>By using our Lottery App, users agree to the terms outlined in this Privacy Policy. If you have any questions or concerns regarding the handling of your personal information, please contact us at our facebook page.</p>";
        echo "</div>";
    }
}

$privacyPolicy = new LotteryAppPrivacyPolicy();
$privacyPolicy->displayPrivacyPolicy();

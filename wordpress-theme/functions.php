<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
define( 'UB_VER', '8.1.4' );
function ub_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'ub_setup' );

/**
 * Host sometimes drops pretty permalinks (Plain), which breaks /hi/ and *-hindi URLs.
 * Keep /%postname%/ so language switch and pretty page URLs resolve correctly.
 */
function ub_ensure_pretty_permalinks() {
	$want = '/%postname%/';
	if ( (string) get_option( 'permalink_structure' ) === $want ) {
		return;
	}
	update_option( 'permalink_structure', $want );
	flush_rewrite_rules( true );
}
add_action( 'after_switch_theme', 'ub_ensure_pretty_permalinks' );
add_action( 'init', 'ub_ensure_pretty_permalinks', 0 );
function ub_assets() {
	wp_enqueue_style( 'ub-fonts', 'https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&family=Source+Sans+3:wght@400;600;700&display=swap', array(), null );
	wp_enqueue_style( 'ub-main', get_template_directory_uri() . '/assets/css/main.css', array( 'ub-fonts' ), UB_VER );
	wp_enqueue_script( 'ub-main', get_template_directory_uri() . '/assets/js/main.js', array(), UB_VER, true );
}
add_action( 'wp_enqueue_scripts', 'ub_assets' );

/**
 * Page SEO titles + meta descriptions (kept in <head>, never shown in page body).
 */
function ub_seo_map() {
	return array(
		'101z-app' => array(
			'title' => '101Z App APK Download – Free ₹79 Bonus | Real Cash Gaming App | ₹300 Withdraw',
			'description' => '1.5M+ Indians Play 101Z App Spin Master APK Daily! Get Real Cash + ₹420 Instant. v11.5.2 APK, UPI, Safe for ₹1 Lakh Pro. 💰 UPI Cashout | Diwali Deal Bonus, Join Now! Play Today',
		),
		'101z-app-hindi' => array(
			'title' => '101Z ऐप APK डाउनलोड करें – मुफ़्त ₹79 बोनस | रियल कैश गेमिंग ऐप | ₹300 निकासी',
			'description' => '1.5 मिलियन से ज़्यादा भारतीय रोज़ाना 101Z ऐप स्पिन मास्टर APK खेलते हैं! असली नकद + ₹420 तुरंत जीतें। v11.5.2 APK, UPI, ₹1 लाख प्रो के लिए सुरक्षित। 💰 UPI से कैश निकालें | दिवाली डील बोनस, अभी जुड़ें! आज ही खेलें',
		),
		'3patti-cards-game' => array(
			'title' => '3patti Cards Game APK Download – Free ₹91 Bonus | Real Cash Gaming App | ₹200 Withdraw',
			'description' => '🔥 3patti cards game Indian King APK APK, Get Unlimited Chips Now! Download v15.3.2 for India 2025, unlock Unlimited Chips + ₹999 daily. ✅ Kids Safe | No Root | Safe | 5G Fast. 🎁 Diwali Deal: Extra ₹500 Chips! 👇 Tap to download.',
		),
		'3patti-cards-game-hindi' => array(
			'title' => '3पत्ती कार्ड्स गेम APK डाउनलोड करें – मुफ़्त ₹91 बोनस | असली पैसे वाला गेमिंग ऐप | ₹200 निकासी',
			'description' => '🔥 3पत्ती कार्ड गेम इंडियन किंग APK डाउनलोड करें, अनलिमिटेड चिप्स पाएं! भारत के लिए v15.3.2 (2025) डाउनलोड करें और अनलिमिटेड चिप्स + प्रतिदिन ₹999 अनलॉक करें। ✅ बच्चों के लिए सुरक्षित | रूट की आवश्यकता नहीं | सुरक्षित | 5G फास्ट। 🎁 दिवाली ऑफर: अतिरिक्त ₹500 चिप्स! 👇 डाउनलोड करने के लिए टैप करें।',
		),
		'567-slots' => array(
			'title' => '567 Slots APK Download – Free ₹91 Bonus | Real Cash Slots App | ₹400 Withdraw',
			'description' => 'Best 567 Slots APK Instant ₹777 2025: Get VIP Unlocked + ₹999 Daily! Cash Pro APK v10.0.4, No Root, Hindi Support. 💰 Paytm Withdraw | 24x7 Live Chat. 🚀 Diwali Deal: Install in 10s & Get Rich!',
		),
		'567-slots-hindi' => array(
			'title' => '567 स्लॉट्स एपीके डाउनलोड करें – मुफ़्त ₹91 बोनस | रियल कैश स्लॉट्स ऐप | ₹400 निकासी',
			'description' => 'बेस्ट 567 स्लॉट्स APK इंस्टेंट ₹777 2025: VIP अनलॉक पाएं + प्रतिदिन ₹999 कमाएं! कैश प्रो APK v10.0.4, रूट की आवश्यकता नहीं, हिंदी सपोर्ट। 💰 पेटीएम से निकासी | 24x7 लाइव चैट। 🚀 दिवाली ऑफर: 10 सेकंड में इंस्टॉल करें और अमीर बनें!',
		),
		'666e-rummy' => array(
			'title' => '666E Rummy APK Download – Free ₹100 Bonus | Real Cash Gaming App | ₹200 Withdraw',
			'description' => 'Don’t miss ₹51 Bonus in 666E Rummy! Hindi APK v15.7.4, Tap & Get Chips, Voice Chat, ₹500/Hr. 🚨 Diwali Deal Ends Soon! सुरक्षित डाउनलोड करें और तुरंत जीतना शुरू करें!',
		),
		'666e-rummy-hindi' => array(
			'title' => '666E रम्मी APK डाउनलोड करें – मुफ़्त ₹100 बोनस | असली नकद गेमिंग ऐप | ₹200 निकासी',
			'description' => 'Don’t miss ₹51 Bonus in 666E Rummy! Hindi APK v15.7.4, Tap & Get Chips, Voice Chat, ₹500/Hr. 🚨 Diwali Deal Ends Soon! सुरक्षित डाउनलोड करें और तुरंत जीतना शुरू करें!',
		),
		'789-slots' => array(
			'title' => '789 Slots APK Download – Free ₹91 Bonus | Real Cash Slots App | ₹200 Withdraw',
			'description' => '🎮 789 Slots Instant APK v13.7.9: Unlock Max Level Instantly! Safe APK, 100% Secure, Live Support, No Ads. 💰 Earn ₹1000/Hr + Max Level. 🚀 Diwali Deal: Free ₹777 Chips! डाउनलोड via MediaFire',
		),
		'789-slots-hindi' => array(
			'title' => '789 स्लॉट्स एपीके डाउनलोड करें – मुफ़्त ₹91 बोनस | रियल कैश स्लॉट्स ऐप | ₹200 निकासी',
			'description' => '🎮 789 स्लॉट्स इंस्टेंट APK v13.7.9: तुरंत अधिकतम लेवल अनलॉक करें! सुरक्षित APK, 100% सुरक्षित, लाइव सपोर्ट, विज्ञापन रहित। 💰 ₹1000/घंटा कमाएँ + अधिकतम लेवल। 🚀 दिवाली ऑफर: मुफ़्त ₹777 चिप्स! MediaFire से डाउनलोड करें',
		),
		'9-rummy' => array(
			'title' => '9 Rummy APK Download – Free ₹65 Bonus | Real Cash Gaming App | ₹100 Withdraw',
			'description' => 'Earn ₹5000/Week in 9 Rummy? Yes with Elite Club APK v10.4.2! Get ₹9999 Bonus + Auto Win. Hindi Lang | For India 2025. 🤑 Diwali Deal: Double Bonus! 👇 Download & Calculate',
		),
		'9-rummy-hindi' => array(
			'title' => '9 रम्मी एपीके डाउनलोड करें – मुफ़्त ₹65 बोनस | असली नकद गेमिंग ऐप | ₹100 निकासी',
			'description' => '9 रम्मी में प्रति सप्ताह ₹5000 कमाएँ? जी हाँ, एलीट क्लब APK v10.4.2 के साथ! ₹9999 बोनस + ऑटो विन पाएँ। हिंदी भाषा | भारत 2025 के लिए। 🤑 दिवाली डील: डबल बोनस! 👇 डाउनलोड करें और गणना करें',
		),
		'about' => array(
			'title' => 'About Yono Game, India’s Trusted Online Gaming Platform in 2026',
			'description' => 'Yono Game is India’s leading real-cash gaming destination for Teen Patti and Rummy enthusiasts.',
		),
		'about-hindi' => array(
			'title' => 'योना गेम के बारे में: 2026 में भारत का सबसे भरोसेमंद ऑनलाइन गेमिंग प्लेटफॉर्म',
			'description' => 'योना गेम, तीन पत्ती और रमी के शौकीनों के लिए भारत का अग्रणी रियल-कैश गेमिंग प्लेटफॉर्म है।',
		),
		'about-us' => array(
			'title' => 'About Yono Game, India’s Trusted Online Gaming Platform in 2026',
			'description' => 'Yono Game is India’s leading real-cash gaming destination for Teen Patti and Rummy enthusiasts.',
		),
		'about-us-hindi' => array(
			'title' => 'योना गेम के बारे में: 2026 में भारत का सबसे भरोसेमंद ऑनलाइन गेमिंग प्लेटफॉर्म',
			'description' => 'योना गेम, तीन पत्ती और रमी के शौकीनों के लिए भारत का अग्रणी रियल-कैश गेमिंग प्लेटफॉर्म है।',
		),
		'apna-ludo' => array(
			'title' => 'Apna Ludo APK Download – Free ₹500 Bonus | Real Cash Gaming App | ₹500 Withdraw',
			'description' => 'Claim ₹9999 Bonus in Apna Ludo Auto Win APK v10.1.9! Install in 10s, signup, and get ₹9999 Bonus + ₹420 Instant. No Root | Hindi | Withdraw via Paytm/UPI | 50MB Mumbai APK',
		),
		'apna-ludo-hindi' => array(
			'title' => 'अपना लूडो एपीके डाउनलोड करें – मुफ़्त ₹500 बोनस | असली पैसे वाला गेमिंग ऐप | ₹500 निकासी',
			'description' => 'अपना लूडो ऑटो विन APK v10.1.9 में ₹9999 का बोनस पाएं! 10 सेकंड में इंस्टॉल करें, साइन अप करें और ₹9999 बोनस + ₹420 तुरंत पाएं। रूट की आवश्यकता नहीं | हिंदी | Paytm/UPI के माध्यम से निकासी | 50MB मुंबई APK',
		),
		'contact' => array(
			'title' => 'Contact Yono Game for All Your Player Support Needs in 2026',
			'description' => 'Contact Yono Game customer support for 24/7 assistance through email, WhatsApp, or live chat for fast and reliable help.',
		),
		'contact-hindi' => array(
			'title' => '2026 में खिलाड़ियों से संबंधित आपकी सभी सहायता आवश्यकताओं के लिए योना गेम से संपर्क करें।',
			'description' => 'त्वरित और विश्वसनीय सहायता के लिए ईमेल, व्हाट्सएप या लाइव चैट के माध्यम से 24/7 सहायता के लिए योना गेम ग्राहक सहायता से संपर्क करें।',
		),
		'contact-us' => array(
			'title' => 'Contact Yono Game for All Your Player Support Needs in 2026',
			'description' => 'Contact Yono Game customer support for 24/7 assistance through email, WhatsApp, or live chat for fast and reliable help.',
		),
		'contact-us-hindi' => array(
			'title' => '2026 में खिलाड़ियों से संबंधित आपकी सभी सहायता आवश्यकताओं के लिए योना गेम से संपर्क करें।',
			'description' => 'त्वरित और विश्वसनीय सहायता के लिए ईमेल, व्हाट्सएप या लाइव चैट के माध्यम से 24/7 सहायता के लिए योना गेम ग्राहक सहायता से संपर्क करें।',
		),
		'daman-game' => array(
			'title' => 'Daman Game APK Download – Free ₹55 Bonus | Real Cash Card Game App | ₹400 Withdraw',
			'description' => 'Tired of losing in Daman Game? Try Elite Club APK v15.0.2: Get ₹5000 Signup Bonus + God Mode! Android 13 | Anti-Ban | Google Drive. 💸 Real Cash | 100% RNG. Diwali Special: Download Now',
		),
		'daman-game-hindi' => array(
			'title' => 'दमन गेम एपीके डाउनलोड करें – मुफ़्त ₹55 बोनस | असली कैश कार्ड गेम ऐप | ₹400 निकासी',
			'description' => 'दमन गेम में हारते-हारते थक गए हैं? एलीट क्लब APK v15.0.2 आज़माएँ: ₹5000 का साइनअप बोनस + गॉड मोड पाएँ! Android 13 | एंटी-बैन | गूगल ड्राइव। 💸 असली नकद | 100% RNG। दिवाली स्पेशल: अभी डाउनलोड करें',
		),
		'dhani-teen-patti' => array(
			'title' => 'Dhani Teen Patti APK Download – Free ₹79 Bonus | Real Cash Gaming App | ₹500 Withdraw',
			'description' => 'New to dhani teen patti? Download प्रीमियम APK v10.8.7 & Get ₹999 Daily Free! No Root | Hindi Lang | Hindi Guide. Best in जीतें दिल्ली 🎁 Diwali Deal: ₹1000 Welcome! 👇 Install in 10s',
		),
		'dhani-teen-patti-hindi' => array(
			'title' => 'धानी तीन पत्ती एपीके डाउनलोड करें – मुफ़्त ₹79 बोनस | असली पैसे वाला गेमिंग ऐप | ₹500 निकासी',
			'description' => 'धानी तीन पत्ती में नए हैं? प्रीमियम APK v10.8.7 डाउनलोड करें और पाएं ₹999 प्रतिदिन मुफ्त! रूट की आवश्यकता नहीं | हिंदी भाषा | हिंदी गाइड। दिल्ली में सर्वश्रेष्ठ! 🎁 दिवाली ऑफर: ₹1000 का स्वागत उपहार! 👇 10 सेकंड में इंस्टॉल करें',
		),
		'disclaimer' => array(
			'title' => 'Learn About Yono Game Legal Status and Compliance in India',
			'description' => 'Read the official Yono Game disclaimer covering third-party apps, financial risks, age restrictions, legal compliance, and user responsibilities for gaming, trading, and earning platforms.',
		),
		'disclaimer-hindi' => array(
			'title' => 'भारत में योना गेम की कानूनी स्थिति और अनुपालन के बारे में जानें',
			'description' => 'योना गेम के आधिकारिक अस्वीकरण को पढ़ें, जिसमें तृतीय-पक्ष ऐप्स, वित्तीय जोखिम, आयु प्रतिबंध, कानूनी अनुपालन और गेमिंग, ट्रेडिंग और कमाई प्लेटफार्मों के लिए उपयोगकर्ता की जिम्मेदारियों को शामिल किया गया है।',
		),
		'diuwin-game' => array(
			'title' => 'Diuwin Game APK Download – Free ₹75 Bonus | Real Cash Gaming App | ₹200 Withdraw',
			'description' => '1.5M+ Indians Play diuwin game Royal APK Daily! Get ₹9999 Bonus + ₹420 Instant. v11.7.9 APK, UPI, Safe for ₹500/Hour. 💰 UPI Cashout | Diwali Deal Bonus – Join Now',
		),
		'diuwin-game-hindi' => array(
			'title' => 'Diuwin गेम APK डाउनलोड करें – मुफ़्त ₹75 बोनस | असली पैसे वाला गेमिंग ऐप | ₹200 निकासी',
			'description' => '1.5 मिलियन से ज़्यादा भारतीय रोज़ाना diuwin Royal APK गेम खेलते हैं! ₹9999 बोनस + ₹420 तुरंत जीतें। v11.7.9 APK, UPI, ₹500 प्रति घंटे के लिए सुरक्षित। 💰 UPI कैशआउट | दिवाली डील बोनस – अभी जुड़ें',
		),
		'dragon-vs-tiger' => array(
			'title' => 'Dragon Vs Tiger APK Download – Free ₹500 Bonus | Real Cash Card Game App | ₹500 Withdraw',
			'description' => 'Ready for RNG Certified fun? Dragon Vs Tiger Cash Pro APK v12.3.1: Safe, Fast, Live Support. Play in Delhi APK & earn via Paytm/UPI. 🌟 Diwali Special: ₹5000 Bonus + Free Chips! Download Now',
		),
		'dragon-vs-tiger-hindi' => array(
			'title' => 'ड्रैगन बनाम टाइगर एपीके डाउनलोड करें - मुफ़्त ₹500 बोनस | असली कैश कार्ड गेम ऐप | ₹500 निकासी',
			'description' => 'RNG सर्टिफाइड गेम का मज़ा लेने के लिए तैयार हैं? Dragon Vs Tiger Cash Pro APK v12.3.1: सुरक्षित, तेज़, लाइव सपोर्ट। दिल्ली में खेलें और Paytm/UPI के ज़रिए कमाएँ। 🌟 दिवाली स्पेशल: ₹5000 बोनस + मुफ़्त चिप्स! अभी डाउनलोड करें।',
		),
		'hello-rummy' => array(
			'title' => 'Hello Rummy APK Download – Free ₹79 Bonus | Real Cash Gaming App | ₹400 Withdraw',
			'description' => '₹ Bonus Alert! Hello Rummy 5G Fast APK Diwali Deal – Safe Download! Earn Real Cash + ₹500/Hr with Auto Win. 💰 Hindi Lang | No Ban | APKPure Verified. Hurry! Diwali Deal ends soon – Claim in Instant ₹777',
		),
		'hello-rummy-hindi' => array(
			'title' => 'हेलो रम्मी एपीके डाउनलोड करें – मुफ़्त ₹79 बोनस | असली नकद गेमिंग ऐप | ₹400 निकासी',
			'description' => 'बोनस अलर्ट! हेलो रम्मी 5G फास्ट APK दिवाली डील – सुरक्षित डाउनलोड! ऑटो विन के साथ असली नकद + ₹500/घंटा कमाएँ। 💰 हिंदी भाषा | कोई प्रतिबंध नहीं | APKPure सत्यापित। जल्दी करें! दिवाली डील जल्द ही समाप्त हो रही है – तुरंत ₹777 प्राप्त करें',
		),
		'ind-bingo' => array(
			'title' => 'IND Bingo APK Download – Free ₹31 Bonus | Real Cash Bingo App | ₹100 Withdraw',
			'description' => 'Best IND Bingo APK in Mega NZ Fast 2025: Play Safely + ₹999 Daily! Elite APK v12.1.6, Free Daily Rewards, Hindi Support. 💰 Paytm Withdraw | 24x7 Live Chat. 🚀 Diwali Offer: Install in 10s',
		),
		'ind-bingo-hindi' => array(
			'title' => 'IND Bingo APK डाउनलोड करें – मुफ़्त ₹31 बोनस | असली कैश बिंगो ऐप | ₹100 निकासी',
			'description' => 'मेगा न्यूज़ीलैंड फास्ट 2025 में सर्वश्रेष्ठ IND बिंगो APK: सुरक्षित रूप से खेलें + प्रतिदिन ₹999 जीतें! एलीट APK v12.1.6, मुफ़्त दैनिक पुरस्कार, हिंदी सपोर्ट। 💰 पेटीएम से निकासी | 24x7 लाइव चैट। 🚀 दिवाली ऑफर: 10 सेकंड में इंस्टॉल करें',
		),
		'jj-rummy' => array(
			'title' => 'JJ Rummy APK Download – Free ₹41 Bonus | Real Cash Rummy App | ₹300 Withdraw',
			'description' => '₹ Bonus Alert! JJ Rummy Anti-Ban APK Diwali Deal: Safe Download! Earn ₹9999 Bonus + ₹500/Hr with Auto Win. 💰 Kids Safe | No Ban | APKPure Verified. Hurry! Diwali Deal ends soon: Claim in 10000 Chips! Start Winning',
		),
		'jj-rummy-hindi' => array(
			'title' => 'JJ Rummy APK डाउनलोड करें – मुफ़्त ₹41 बोनस | रियल कैश रमी ऐप | ₹300 निकासी',
			'description' => '₹ बोनस अलर्ट! जेजे रम्मी एंटी-बैन एपीके दिवाली डील: सुरक्षित डाउनलोड! ऑटो विन के साथ ₹9999 बोनस + ₹500/घंटा कमाएँ। 💰 बच्चों के लिए सुरक्षित | कोई प्रतिबंध नहीं | APKPure सत्यापित। जल्दी करें! दिवाली डील जल्द ही समाप्त हो रही है: 10000 चिप्स पाएं! जीतना शुरू करें!',
		),
		'kash-rummy' => array(
			'title' => 'Kash Rummy APK Download – Free ₹79 Bonus | Real Cash Gaming App | ₹300 Withdraw',
			'description' => 'Tired of Losing in kash rummy? Try 5G Fast APK APK v13.1.1 – Unlock 100% Legal + God Mode! Low RAM | Anti-Ban | For Tap & Get Chips. 💸 Real Cash | 100% RNG. Diwali Deal Special – Download Now',
		),
		'kash-rummy-hindi' => array(
			'title' => 'कैश रम्मी एपीके डाउनलोड करें – मुफ़्त ₹79 बोनस | असली नकद गेमिंग ऐप | ₹300 निकासी',
			'description' => 'कैश रमी में हारते-हारते थक गए हैं? 5G Fast APK v13.1.1 आज़माएँ – 100% कानूनी + गॉड मोड अनलॉक करें! कम रैम | एंटी-बैन | टैप करके चिप्स प्राप्त करें। 💸 असली कैश | 100% RNG। दिवाली स्पेशल ऑफर – अभी डाउनलोड करें',
		),
		'lucky-rummy' => array(
			'title' => 'Lucky Rummy APK Download – Free ₹75 Bonus | Real Cash Gaming App | ₹200 Withdraw',
			'description' => 'Ready for No Root? lucky rummy 100% Safe APK APK v14.7.1 – Safe, Fast, Kids Safe. Play in No Virus, earn via Paytm/UPI. 🌟 Diwali Deal Special: ₹5000 Bonus + Free Chips! Download Now',
		),
		'lucky-rummy-hindi' => array(
			'title' => 'लकी रमी एपीके डाउनलोड करें – मुफ़्त ₹75 बोनस | असली नकद गेमिंग ऐप | ₹200 निकासी',
			'description' => 'बिना रूट के खेलने के लिए तैयार हैं? लकी रमी 100% सुरक्षित APK APK v14.7.1 – सुरक्षित, तेज़, बच्चों के लिए सुरक्षित। वायरस मुक्त खेलें, Paytm/UPI के ज़रिए कमाएँ। 🌟 दिवाली स्पेशल ऑफर: ₹5000 बोनस + मुफ़्त चिप्स! अभी डाउनलोड करें',
		),
		'master-teen-patti' => array(
			'title' => 'Master Teen Patti APK Download – Free ₹25 Bonus | Real Cash Gaming App | ₹300 Withdraw',
			'description' => '1.5M+ Indians Play master teen patti 777 Pro APK Daily! Get All Tables Open + ₹420 Instant. v11.6.3 APK, Android 14, Safe for Earn Bangalore. 💰 UPI Cashout | Diwali Deal Bonus, Join Now',
		),
		'master-teen-patti-hindi' => array(
			'title' => 'मास्टर तीन पत्ती एपीके डाउनलोड करें – मुफ़्त ₹25 बोनस | असली पैसे वाला गेमिंग ऐप | ₹300 निकासी',
			'description' => '1.5 मिलियन से ज़्यादा भारतीय रोज़ाना Master Teen Patti 777 Pro APK खेलते हैं! सभी टेबल खोलें और तुरंत ₹420 जीतें। v11.6.3 APK, Android 14, बैंगलोर में सुरक्षित कमाई। 💰 UPI से कैश निकालें | दिवाली डील बोनस, अभी जुड़ें',
		),
		'mkm-bet' => array(
			'title' => 'MKM Bet APK Download – Free ₹51 Bonus | Real Cash Gaming App | ₹300 Withdraw',
			'description' => 'Play MKM Bet on any phone! 100% Safe APK v10.1.9: Auto Win + APK Mirror. Works on Android 10–14, 10000 Chips. 💸 Paytm | Diwali Deal Offer: Install Now',
		),
		'mkm-bet-hindi' => array(
			'title' => 'MKM Bet APK डाउनलोड करें – मुफ़्त ₹51 बोनस | असली पैसे वाला गेमिंग ऐप | ₹300 निकासी',
			'description' => 'किसी भी फ़ोन पर MKM Bet खेलें! 100% सुरक्षित APK v10.1.9: ऑटो विन + APK मिरर। Android 10–14 पर काम करता है, 10000 चिप्स। 💸 Paytm | दिवाली डील ऑफर: अभी इंस्टॉल करें',
		),
		'mpl-teen-patti' => array(
			'title' => 'MPL Teen Patti APK Download – Free ₹51 Bonus | Real Cash Gaming App | ₹400 Withdraw',
			'description' => 'Earn ₹5000/Week in mpl teen patti? Yes with Ad-Free APK v13.1.3! Get Unlimited Spins + Auto Win. Multiplayer | For No Virus. 🤑 Diwali Deal: Double Bonus! 👇 Download & Calculate',
		),
		'mpl-teen-patti-hindi' => array(
			'title' => 'MPL Teen Patti APK डाउनलोड करें – मुफ़्त ₹51 बोनस | असली पैसे वाला गेमिंग ऐप | ₹400 निकासी',
			'description' => 'MPL Teen Patti में हर हफ्ते ₹5000 कमाएँ? जी हाँ, विज्ञापन-मुक्त APK v13.1.3 के साथ! असीमित स्पिन + ऑटो विन पाएँ। मल्टीप्लेयर | वायरस-मुक्त। 🤑 दिवाली डील: डबल बोनस! 👇 डाउनलोड करें और गणना करें',
		),
		'mqm-bet' => array(
			'title' => 'MQM Bet APK Download – Free ₹31 Bonus | Real Cash Gaming App | ₹500 Withdraw',
			'description' => 'Play MQM Bet on Any Phone! Chips Mod APK v10.3.3 APK – God Mode + 100MB/s. Works on Android 10-14, Bharat Pro. 💸 Paytm | Diwali Deal Offer – Install Now',
		),
		'mqm-bet-hindi' => array(
			'title' => 'MQM Bet APK डाउनलोड करें – मुफ़्त ₹31 बोनस | असली पैसे वाला गेमिंग ऐप | ₹500 निकासी',
			'description' => 'किसी भी फ़ोन पर MQM Bet खेलें! Chips Mod APK v10.3.3 APK – गॉड मोड + 100MB/s। Android 10-14 और Bharat Pro पर काम करता है। 💸 Paytm | दिवाली डील ऑफर – अभी इंस्टॉल करें',
		),
		'predict-wingo' => array(
			'title' => 'Predict Wingo APK Download – Free ₹200 Bonus | Real Cash Gaming App | ₹500 Withdraw',
			'description' => '💥 predict wingo Cash Pro APK – Auto Win Awaits! Download v14.5.5 APK (Live Support) for 100% Safe. No Root | Hindi Support | Real Cash. 🎁 Diwali Deal: Get ₹999 Extra! 👇 Secure Link, Start Winning! Start Winning',
		),
		'predict-wingo-hindi' => array(
			'title' => 'Predict Wingo APK डाउनलोड करें – मुफ़्त ₹200 बोनस | असली पैसे वाला गेमिंग ऐप | ₹500 निकासी',
			'description' => '💥 प्रेडिक्ट विंगो कैश प्रो एपीके – ऑटो जीत आपका इंतज़ार कर रही है! 100% सुरक्षित उपयोग के लिए v14.5.5 एपीके डाउनलोड करें (लाइव सपोर्ट उपलब्ध है)। रूट की आवश्यकता नहीं | हिंदी सपोर्ट | असली नकद। 🎁 दिवाली ऑफर: ₹999 अतिरिक्त पाएं! 👇 सुरक्षित लिंक, जीतना शुरू करें!',
		),
		'predictor-aviator' => array(
			'title' => 'Predictor Aviator APK Download – Free ₹91 Bonus | Real Cash Gaming App | ₹500 Withdraw',
			'description' => 'Earn ₹5000/Week in Predictor Aviator with Elite APK v10.9.8! पाएं No Root + Auto Win. 3D Graphics | For Desi Hindi. 🤑 Diwali Deal: Double बोनस 👇 Download & Calculate',
		),
		'predictor-aviator-hindi' => array(
			'title' => 'Predictor Aviator APK डाउनलोड करें – मुफ़्त ₹91 बोनस | असली पैसे वाला गेमिंग ऐप | ₹500 निकासी',
			'description' => 'Elite APK v10.9.8 के साथ Predictor Aviator में प्रति सप्ताह ₹5000 कमाएँ! पाएँ: रूट की आवश्यकता नहीं + ऑटो जीत। 3D ग्राफ़िक्स | देसी हिंदी के लिए। 🤑 दिवाली डील: डबल बोनस 👇 डाउनलोड करें और गणना करें',
		),
		'rainbow-rummy' => array(
			'title' => 'Rainbow Rummy APK Download – Free ₹91 Bonus | Real Cash Gaming App | ₹100 Withdraw',
			'description' => 'Limited Diwali Deal! Rainbow Rummy No Root APK – Grab Free Shopping + 10000 Free Chips! ✨ God Mode, Anti-Ban, Max Level. 🌍 100% Safe | 60FPS | 50MB. 💸 Real Money | 100% Cashback. 👉 Install Now! Get Rich',
		),
		'rainbow-rummy-hindi' => array(
			'title' => 'रेनबो रमी एपीके डाउनलोड करें – मुफ़्त ₹91 बोनस | असली नकद गेमिंग ऐप | ₹100 निकासी',
			'description' => 'दिवाली का सीमित ऑफर! रेनबो रमी नो रूट APK - मुफ़्त शॉपिंग + 10000 मुफ़्त चिप्स पाएं! ✨ गॉड मोड, एंटी-बैन, अधिकतम लेवल। 🌍 100% सुरक्षित | 60FPS | 50MB। 💸 असली पैसे | 100% कैशबैक। 👉 अभी इंस्टॉल करें! अमीर बनें!',
		),
		'real-cash-teen-patti' => array(
			'title' => 'Real Cash Teen Patti APK Download – Free ₹200 Bonus | Real Cash Gaming App | ₹200 Withdraw',
			'description' => '🚀 real cash teen patti Earn Pro APK Diwali Deal – Claim VIP Unlocked + ₹1000 Instant! v11.4.1 APK for Desi Hindi, UPI, no ban. 💸 Real Money | 24x7 Support. 👉 Safe Download – Join 2M+ Players! Get Rich',
		),
		'real-cash-teen-patti-hindi' => array(
			'title' => 'रियल कैश तीन पत्ती एपीके डाउनलोड करें – मुफ़्त ₹200 बोनस | रियल कैश गेमिंग ऐप | ₹200 निकासी',
			'description' => '🚀 तीन पत्ती अर्न प्रो APK दिवाली डील - VIP अनलॉक पाएं + तुरंत ₹1000 जीतें! v11.4.1 APK देसी हिंदी, UPI, बिना किसी प्रतिबंध के। 💸 असली पैसा | 24x7 सपोर्ट। 👉 सुरक्षित डाउनलोड - 20 लाख से ज़्यादा खिलाड़ियों से जुड़ें! अमीर बनें',
		),
		'rummy-500-bonus' => array(
			'title' => 'Rummy 500 Bonus APK Download – Free ₹51 Bonus | Real Cash Rummy App | ₹200 Withdraw',
			'description' => 'Diwali 2025 Special! Rummy 500 Bonus VIP प्रो APK APK: Claim ₹500 Bonus + 50000 Chips! v13.7.7 for Kolkata APK, Tournament, 60FPS. 🎁 Extra ₹999 बोनस | Limited 24H! 👇 Tap to Install',
		),
		'rummy-500-bonus-hindi' => array(
			'title' => 'Rummy 500 Bonus APK डाउनलोड करें – मुफ़्त ₹51 बोनस | रियल कैश रमी ऐप | ₹200 निकासी',
			'description' => 'दिवाली 2025 स्पेशल! रम्मी 500 बोनस वीआईपी प्रो APK: ₹500 बोनस + 50000 चिप्स पाएं! कोलकाता के लिए v13.7.7 APK, टूर्नामेंट, 60FPS। 🎁 अतिरिक्त ₹999 बोनस | सीमित 24 घंटे! 👇 इंस्टॉल करने के लिए टैप करें',
		),
		'rummy-aviator' => array(
			'title' => 'Rummy Aviator APK Download – Free ₹79 Bonus | Real Cash Gaming App | ₹4200 Withdraw',
			'description' => 'Start Earning in Rummy Aviator in 3 Steps: 1. Download Premium APK v13.1.3 2. Get Unlimited Spins 3. Withdraw ₹5000! Tournament | For 10000 Chips | Hindi. 🚀 Diwali Deal: Tap Now',
		),
		'rummy-aviator-hindi' => array(
			'title' => 'Rummy Aviator APK डाउनलोड करें – मुफ़्त ₹79 बोनस | असली पैसे वाला गेमिंग ऐप | ₹4200 निकासी',
			'description' => 'रम्मी एविएटर में 3 आसान चरणों में कमाई शुरू करें: 1. प्रीमियम APK v13.1.3 डाउनलोड करें 2. असीमित स्पिन प्राप्त करें 3. ₹5000 निकालें! टूर्नामेंट | 10000 चिप्स के लिए | हिंदी। 🚀 दिवाली ऑफर: अभी टैप करें',
		),
		'rummy-bindaas' => array(
			'title' => 'Rummy Bindaas APK Download – Free ₹65 Bonus | Real Cash Rummy App | ₹100 Withdraw',
			'description' => '🎮 Rummy Bindaas Win Pro APK v11.9.4: Unlock ₹51 Bonus Instantly! Safe Low Data 50MB APK, 3D Graphics, No Ads. 💰 Earn ₹1000/Hr + ₹51 Bonus. 🚀 Diwali Deal: Free ₹777 Chips via MediaFire',
		),
		'rummy-bindaas-hindi' => array(
			'title' => 'Rummy Bindaas APK डाउनलोड करें – मुफ़्त ₹65 बोनस | रियल कैश रमी ऐप | ₹100 निकासी',
			'description' => '🎮 Rummy Bindaas Win Pro APK v11.9.4: तुरंत ₹51 का बोनस पाएं! सुरक्षित, कम डेटा खपत वाला 50MB APK, 3D ग्राफ़िक्स, विज्ञापन रहित। 💰 ₹1000 प्रति घंटा कमाएं + ₹51 का बोनस। 🚀 दिवाली ऑफर: MediaFire के ज़रिए मुफ़्त ₹777 चिप्स पाएं।',
		),
		'rummy-bloc' => array(
			'title' => 'Rummy Bloc APK Download – Free ₹100 Bonus | Real Cash Gaming App | ₹400 Withdraw',
			'description' => 'New to Rummy Bloc? Download VIP Pro APK v13.9.1 & Get Paytm Cash Free! No Root | UPI | Hindi Guide. Best in Mumbai APK. 🎁 Diwali Deal: ₹1000 Welcome! 👇 Install in 10s',
		),
		'rummy-bloc-hindi' => array(
			'title' => 'Rummy Bloc APK डाउनलोड करें – मुफ़्त ₹100 बोनस | असली पैसे वाला गेमिंग ऐप | ₹400 निकासी',
			'description' => 'Rummy Bloc में नए हैं? VIP Pro APK v13.9.1 डाउनलोड करें और मुफ़्त Paytm कैश पाएं! रूट की आवश्यकता नहीं | UPI | हिंदी गाइड। मुंबई में सर्वश्रेष्ठ APK। 🎁 दिवाली ऑफर: ₹1000 का वेलकम गिफ्ट! 👇 10 सेकंड में इंस्टॉल करें',
		),
		'rummy-club' => array(
			'title' => 'Rummy Club APK Download – Free ₹100 Bonus | Real Cash Gaming App | ₹200 Withdraw',
			'description' => 'Earn ₹5000/Week in Rummy Club? Yes with Elite Club APK v11.0.9! Get ₹420 Instant + Auto Win. Daily Free | For ₹1 Lakh Pro. 🤑 Diwali Deal: Double Bonus! 👇 Download & Calculate! Play Today',
		),
		'rummy-club-hindi' => array(
			'title' => 'रमी क्लब एपीके डाउनलोड करें – मुफ़्त ₹100 बोनस | असली नकद गेमिंग ऐप | ₹200 निकासी',
			'description' => 'रमी क्लब में प्रति सप्ताह ₹5000 कमाएँ? जी हाँ, एलीट क्लब APK v11.0.9 के साथ! तुरंत ₹420 प्राप्त करें + ऑटो विन। प्रतिदिन मुफ़्त | ₹1 लाख प्रो के लिए। 🤑 दिवाली डील: डबल बोनस! 👇 डाउनलोड करें और गणना करें! आज ही खेलें',
		),
		'rummy-east' => array(
			'title' => 'Rummy East APK Download – Free ₹100 Bonus | Real Cash Gaming App | ₹500 Withdraw',
			'description' => 'New to Rummy East? Download Low Data APK v15.0.2 & enjoy No Root access! Tournament | Hindi Guide | Secure ₹5000 Delhi Play. 🎁 Diwali Deal: ₹1000 Welcome Bonus! 👇 Install in 10 Seconds',
		),
		'rummy-east-hindi' => array(
			'title' => 'Rummy East APK डाउनलोड करें – मुफ़्त ₹100 बोनस | असली नकद गेमिंग ऐप | ₹500 निकासी',
			'description' => 'Rummy East में नए हैं? Low Data APK v15.0.2 डाउनलोड करें और बिना रूट एक्सेस के आनंद लें! टूर्नामेंट | हिंदी गाइड | दिल्ली में ₹5000 का सुरक्षित इनाम जीतें। 🎁 दिवाली ऑफर: ₹1000 का वेलकम बोनस! 👇 10 सेकंड में इंस्टॉल करें',
		),
	);
}

function ub_current_seo() {
	$map = ub_seo_map();
	if ( is_front_page() ) {
		return array(
			'title' => 'Yono Games 2026 – All Yono Games List APK Download',
			'description' => 'Explore the All Yono Games list and get the latest Yono Games APK download links. Check sign-up bonus offers, install guide, update info, and safe download tips in one place.',
		);
	}
	if ( is_page() ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( $slug && isset( $map[ $slug ] ) ) {
			return $map[ $slug ];
		}
		// Template filename fallback: page-about-us.html -> about-us
		$tmpl = (string) get_page_template_slug();
		if ( $tmpl && 0 === strpos( $tmpl, 'page-' ) ) {
			$key = preg_replace( '/\.html$/', '', substr( $tmpl, 5 ) );
			if ( isset( $map[ $key ] ) ) {
				return $map[ $key ];
			}
		}
	}
	return null;
}

function ub_document_title( $title ) {
	$seo = ub_current_seo();
	if ( $seo && ! empty( $seo['title'] ) ) {
		$title['title'] = $seo['title'];
		$title['tagline'] = '';
	} elseif ( is_front_page() ) {
		$title['title'] = 'Yono Games 2026 – All Yono Games List APK Download';
		$title['tagline'] = '';
	}
	return $title;
}
add_filter( 'document_title_parts', 'ub_document_title' );

function ub_meta_description() {
	$seo = ub_current_seo();
	if ( ! $seo || empty( $seo['description'] ) ) {
		return;
	}
	echo '<meta name="description" content="' . esc_attr( $seo['description'] ) . '" />' . "\n";
}
add_action( 'wp_head', 'ub_meta_description', 1 );

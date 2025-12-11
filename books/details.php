<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Prints - Book Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Georgia', 'Times New Roman', serif;
        }

        body {
            background-color: #f5f1e8;
            color: #3a2c1c;
            line-height: 1.6;
            padding: 20px;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="%23e8e0d0" opacity="0.3" d="M10,50 Q25,30 50,50 T90,50 Q75,70 50,50 T10,50"></path></svg>');
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 40px;
            border: 1px solid #e0d6c2;
        }

        .book-cover-section {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .book-cover {
            width: 100%;
            max-width: 350px;
            height: 450px;
            background: linear-gradient(135deg, #d4a574 0%, #b5834f 100%);
            border-radius: 8px 20px 20px 8px;
            box-shadow: 15px 15px 30px rgba(0, 0, 0, 0.2), 
                        inset 5px 0 15px rgba(255, 255, 255, 0.4),
                        inset -5px 0 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            border-left: 15px solid #8b5a2b;
        }

        .book-cover::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><path fill="none" stroke="%23907050" stroke-width="0.5" d="M10,10 L90,10 M10,30 L90,30 M10,50 L90,50 M10,70 L90,70 M10,90 L90,90"></path></svg>');
            opacity: 0.3;
        }

        .book-title {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 80%;
        }

        .book-title h1 {
            font-size: 2.8rem;
            color: #3a2c1c;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 15px;
            font-weight: bold;
            line-height: 1.2;
        }

        .book-title .author {
            font-size: 1.4rem;
            color: #5d4a2e;
            font-style: italic;
            border-top: 2px solid #8b5a2b;
            padding-top: 10px;
            display: inline-block;
        }

        .book-spine {
            position: absolute;
            left: -15px;
            top: 20px;
            width: 15px;
            height: calc(100% - 40px);
            background: linear-gradient(to right, #6b4c2c, #8b5a2b, #6b4c2c);
            border-radius: 3px 0 0 3px;
        }

        .book-details {
            flex: 2;
            min-width: 300px;
        }

        .section-header {
            font-size: 1.8rem;
            color: #8b5a2b;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e0d6c2;
            display: flex;
            align-items: center;
        }

        .section-header i {
            margin-right: 12px;
            background-color: #f0e6d6;
            padding: 10px;
            border-radius: 50%;
        }

        .description-box {
            background-color: #f9f6f0;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 5px solid #d4a574;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .description-box p {
            margin-bottom: 15px;
            font-size: 1.1rem;
            color: #5a4a32;
        }

        .highlight {
            font-weight: bold;
            color: #8b5a2b;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #e0d6c2;
        }

        .detail-item h3 {
            color: #8b5a2b;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .detail-item p {
            color: #5a4a32;
        }

        .price-box {
            background-color: #f0e6d6;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
            border: 2px dashed #d4a574;
        }

        .price {
            font-size: 3rem;
            font-weight: bold;
            color: #8b5a2b;
            margin-bottom: 5px;
        }

        .price-label {
            font-size: 1.2rem;
            color: #5a4a32;
        }

        .buttons-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }

        .btn {
            flex: 1;
            min-width: 200px;
            padding: 18px 25px;
            border-radius: 8px;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
        }

        .btn-cart {
            background-color: #8b5a2b;
            color: white;
        }

        .btn-cart:hover {
            background-color: #6b4c2c;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(139, 90, 43, 0.3);
        }

        .btn-download {
            background-color: #d4a574;
            color: #3a2c1c;
        }

        .btn-download:hover {
            background-color: #b5834f;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(212, 165, 116, 0.3);
        }

        .btn i {
            margin-right: 12px;
            font-size: 1.3rem;
        }

        .recommended-section {
            background-color: #f9f6f0;
            padding: 25px;
            border-radius: 8px;
            border-top: 5px solid #8b5a2b;
        }

        .recommended-section h3 {
            color: #8b5a2b;
            margin-bottom: 15px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }

        .recommended-section h3 i {
            margin-right: 10px;
        }

        .recommended-link {
            display: inline-block;
            color: #8b5a2b;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2rem;
            padding: 12px 20px;
            background-color: white;
            border-radius: 6px;
            transition: all 0.3s;
            border: 1px solid #e0d6c2;
        }

        .recommended-link:hover {
            background-color: #8b5a2b;
            color: white;
            transform: translateX(10px);
        }

        .recommended-link i {
            margin-left: 8px;
            transition: transform 0.3s;
        }

        .recommended-link:hover i {
            transform: translateX(5px);
        }

        .book-icons {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-top: 20px;
            color: #8b5a2b;
        }

        .book-icons i {
            font-size: 1.8rem;
            opacity: 0.7;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: #8b5a2b;
            font-size: 0.9rem;
            border-top: 1px solid #e0d6c2;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                flex-direction: column;
            }
            
            .book-cover {
                max-width: 280px;
                height: 380px;
            }
            
            .book-title h1 {
                font-size: 2.2rem;
            }
            
            .btn {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="book-cover-section">
            <div class="book-cover">
                <div class="book-spine"></div>
                <div class="book-title">
                    <h1>The Silent Patient</h1>
                    <div class="author">Alex Michaelides</div>
                </div>
            </div>
            
            <div class="book-icons">
                <i class="fas fa-book-open"></i>
                <i class="fas fa-feather-alt"></i>
                <i class="fas fa-bookmark"></i>
                <i class="fas fa-pen-nib"></i>
            </div>
        </div>
        
        <div class="book-details">
            <div class="section-header">
                <i class="fas fa-file-alt"></i>
                <span>Description</span>
            </div>
            
            <div class="description-box">
                <p> <span class="highlight">"The Silent Patient "</span>is about a famous painter, Alicia Berenson, who shoots her husband and then never speaks again. Years later, psychotherapist Theo Faber becomes obsessed with uncovering why she did it—and whether her silence is hiding something even more shocking. The book is famous for its jaw-dropping twist.</p>
            
            </div>
            
            <div class="details-grid">
                <div class="detail-item">
                    <h3><i class="fas fa-user-secret"></i> Author</h3>
                    <p>Alex Michaelides</p>
                </div>
                
                <div class="detail-item">
                    <h3><i class="fas fa-edit"></i> tittle</h3>
                    <p>The Silent Patient</p>
                </div>
                
              
               
            </div>
            
            <div class="price-box">
                <div class="price">$32.00</div>
                <div class="price-label">USD - Digital Edition</div>
            </div>
            
            <div class="buttons-container">
                <button class="btn btn-cart" id="addToCartBtn">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                
                <button class="btn btn-download" id="downloadBtn">
                    <i class="fas fa-download"></i> Download Sample
                </button>
            </div>
            
            <div class="recommended-section">
                <h3><i class="fas fa-star"></i> Recommended</h3>
                <a href="#" class="recommended-link">
                    My Time here to Learn 
                    <i class="fas fa-arrow-right"></i>
                </a>
                <div class="book-icons">
                    <i class="fas fa-book"></i>
                    <i class="fas fa-graduation-cap"></i>
                    <i class="fas fa-lightbulb"></i>
                    <i class="fas fa-university"></i>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <p>The Silent Patient &copy; 2023 | An allegorical exploration of digital consumption through social media</p>
    </footer>

    <script>
        // Add to Cart button functionality
        document.getElementById('addToCartBtn').addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-check"></i> Added to Cart!';
            btn.style.backgroundColor = '#4a7c59';
            
            // Show notification
            showNotification('"Food Prints" has been added to your cart!', 'success');
            
            // Reset button after 3 seconds
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.backgroundColor = '';
            }, 3000);
        });
        
        // Download button functionality
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Downloading...';
            
            // Simulate download process
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> Downloaded!';
                btn.style.backgroundColor = '#4a7c59';
                
                // Show notification
                showNotification('Sample of "Food Prints" downloaded successfully!', 'success');
                
                // Reset button after 3 seconds
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.backgroundColor = '';
                }, 3000);
            }, 2000);
        });
        
        // Notification function
        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.innerHTML = `
                <div style="position: fixed; top: 20px; right: 20px; background: ${type === 'success' ? '#4a7c59' : '#8b5a2b'}; color: white; padding: 15px 25px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); z-index: 1000; display: flex; align-items: center; animation: slideIn 0.3s ease;">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}" style="margin-right: 10px;"></i>
                    <span>${message}</span>
                </div>
            `;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Add animation styles
            const style = document.createElement('style');
            style.innerHTML = `
                @keyframes slideIn {
                    from { transform: translateX(100%); opacity: 0; }
                    to { transform: translateX(0); opacity: 1; }
                }
            `;
            document.head.appendChild(style);
            
            // Remove after 4 seconds
            setTimeout(() => {
                notification.firstElementChild.style.animation = 'slideOut 0.3s ease';
                notification.firstElementChild.style.transform = 'translateX(100%)';
                notification.firstElementChild.style.opacity = '0';
                
                setTimeout(() => {
                    document.body.removeChild(notification);
                    document.head.removeChild(style);
                }, 300);
            }, 4000);
        }
        
        // Add book cover animation on page load
        window.addEventListener('load', function() {
            const bookCover = document.querySelector('.book-cover');
            bookCover.style.transform = 'rotateY(10deg)';
            bookCover.style.transition = 'transform 1s ease';
            
            setTimeout(() => {
                bookCover.style.transform = 'rotateY(0)';
            }, 500);
        });
    </script>
</body>
</html>
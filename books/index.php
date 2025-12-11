<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Prints - Book Collection</title>
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

        .page-header {
            max-width: 1200px;
            margin: 0 auto 40px;
            text-align: center;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border-bottom: 5px solid #8b5a2b;
        }

        .page-header h1 {
            font-size: 3.2rem;
            color: #8b5a2b;
            margin-bottom: 10px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .page-header p {
            font-size: 1.3rem;
            color: #5a4a32;
            max-width: 800px;
            margin: 0 auto;
            font-style: italic;
        }

        .books-collection {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .book-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #e0d6c2;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #d4a574 0%, #b5834f 100%);
            padding: 25px 20px;
            text-align: center;
            position: relative;
            min-height: 120px;
            border-bottom: 5px solid #8b5a2b;
        }

        .book-number {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(139, 90, 43, 0.8);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .card-header h2 {
            font-size: 1.8rem;
            color: #3a2c1c;
            margin-bottom: 8px;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        }

        .card-header .author {
            font-size: 1.1rem;
            color: #5d4a2e;
            font-style: italic;
            border-top: 1px solid rgba(139, 90, 43, 0.3);
            padding-top: 8px;
            display: inline-block;
        }

        .card-body {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .book-description {
            color: #5a4a32;
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .highlight {
            font-weight: bold;
            color: #8b5a2b;
        }

        .book-meta {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #e0d6c2;
        }

        .meta-item {
            text-align: center;
        }

        .meta-item h4 {
            color: #8b5a2b;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .meta-item p {
            color: #5a4a32;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .card-footer {
            padding: 0 25px 25px;
            display: flex;
            gap: 12px;
        }

        .card-btn {
            flex: 1;
            padding: 14px 15px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.95rem;
        }

        .card-btn-cart {
            background-color: #8b5a2b;
            color: white;
        }

        .card-btn-cart:hover {
            background-color: #6b4c2c;
        }

        .card-btn-download {
            background-color: #f0e6d6;
            color: #3a2c1c;
        }

        .card-btn-download:hover {
            background-color: #e0d6c2;
        }

        .card-btn i {
            margin-right: 8px;
        }

        .recommended-section {
            max-width: 1200px;
            margin: 50px auto 0;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border-top: 5px solid #d4a574;
        }

        .recommended-section h2 {
            color: #8b5a2b;
            margin-bottom: 20px;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
        }

        .recommended-section h2 i {
            margin-right: 12px;
        }

        .recommended-link {
            display: inline-block;
            color: #8b5a2b;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2rem;
            padding: 12px 25px;
            background-color: #f9f6f0;
            border-radius: 8px;
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
            margin-top: 25px;
            color: #8b5a2b;
        }

        .book-icons i {
            font-size: 1.8rem;
            opacity: 0.7;
            transition: opacity 0.3s;
        }

        .book-icons i:hover {
            opacity: 1;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 25px;
            color: #8b5a2b;
            font-size: 0.9rem;
            border-top: 1px solid #e0d6c2;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .books-collection {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
            
            .page-header h1 {
                font-size: 2.5rem;
            }
            
            .card-footer {
                flex-direction: column;
            }
        }

        @media (max-width: 600px) {
            .books-collection {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>books Collection</h1>
        <p>Explore our curated selection of allegorical books on digital consumption and social media</p>
    </div>

    <div class="books-collection">
        <!-- Book Card 1 -->
        <div class="book-card">
            <div class="card-header">
                <div class="book-number">1</div>
                <h2>The Silent Patient</h2>
                <div class="author">Alex Michaelides</div>
            </div>
            <div class="card-body">
                <div class="book-description">
                    <p><span class="highlight"> <span class="highlight">"The Silent Patient"</span> is about a famous painter, Alicia Berenson, who shoots her husband and then never speaks again. Years later, psychotherapist Theo Faber becomes obsessed with uncovering why she did it—and whether her silence is hiding something even more shocking. The book is famous for its jaw-dropping twist..</p>
                </div>
                <div class="book-meta">
                    <div class="meta-item">
                        <h4>Pages</h4>
                        <p>248</p>
                    </div>
                    <div class="meta-item">
                        <h4>Format</h4>
                        <p>Digital</p>
                    </div>
                    <div class="meta-item">
                        <h4>Price</h4>
                        <p>$32.00</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="card-btn card-btn-cart" onclick="addToCart('Food Prints')">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                <button class="card-btn card-btn-download" onclick="downloadBook('Food Prints')">
                    <i class="fas fa-download"></i> Sample
                </button>
            </div>
        </div>

        <!-- Book Card 2 -->
        <div class="book-card">
            <div class="card-header">
                <div class="book-number">2</div>
                <h2>Digital Breadcrumbs</h2>
                <div class="author">by Alex Morgan</div>
            </div>
            <div class="card-body">
                <div class="book-description">
                    <p>An exploration of how our online activities leave permanent traces. <span class="highlight">Digital Breadcrumbs</span> examines the invisible trail we create with every click, like, and share.</p>
                    <p>Morgan argues that in the age of hyper-connectivity, our digital footprints have become more revealing than our physical ones, creating new challenges for privacy and identity.</p>
                </div>
                <div class="book-meta">
                    <div class="meta-item">
                        <h4>Pages</h4>
                        <p>312</p>
                    </div>
                    <div class="meta-item">
                        <h4>Format</h4>
                        <p>Print & Digital</p>
                    </div>
                    <div class="meta-item">
                        <h4>Price</h4>
                        <p>$28.50</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="card-btn card-btn-cart" onclick="addToCart('Digital Breadcrumbs')">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                <button class="card-btn card-btn-download" onclick="downloadBook('Digital Breadcrumbs')">
                    <i class="fas fa-download"></i> Sample
                </button>
            </div>
        </div>

        <!-- Book Card 3 -->
        <div class="book-card">
            <div class="card-header">
                <div class="book-number">3</div>
                <h2>The Algorithm's Appetite</h2>
                <div class="author">by Samantha Lee</div>
            </div>
            <div class="card-body">
                <div class="book-description">
                    <p>This book explores how social media algorithms <span class="highlight">consume our attention</span> and shape our realities. Lee provides a compelling metaphor of algorithms as hungry entities feeding on our data.</p>
                    <p>Through case studies and personal narratives, the book reveals how personalized content creates echo chambers that limit our worldview while maximizing engagement.</p>
                </div>
                <div class="book-meta">
                    <div class="meta-item">
                        <h4>Pages</h4>
                        <p>289</p>
                    </div>
                    <div class="meta-item">
                        <h4>Format</h4>
                        <p>Digital</p>
                    </div>
                    <div class="meta-item">
                        <h4>Price</h4>
                        <p>$35.00</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="card-btn card-btn-cart" onclick="addToCart('The Algorithm\'s Appetite')">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                <button class="card-btn card-btn-download" onclick="downloadBook('The Algorithm\'s Appetite')">
                    <i class="fas fa-download"></i> Sample
                </button>
            </div>
        </div>

        <!-- Book Card 4 -->
        <div class="book-card">
            <div class="card-header">
                <div class="book-number">4</div>
                <h2>Virtual Nourishment</h2>
                <div class="author">by Jordan Chen</div>
            </div>
            <div class="card-body">
                <div class="book-description">
                    <p>Chen examines how we seek <span class="highlight">emotional sustenance</span> from digital interactions. The book argues that while social media promises connection, it often delivers empty calories for the soul.</p>
                    <p>Through interviews and psychological research, Virtual Nourishment explores why digital consumption leaves us feeling simultaneously full and empty, connected yet isolated.</p>
                </div>
                <div class="book-meta">
                    
                    
                    <div class="meta-item">
                        <h4>Price</h4>
                        <p>$30.00</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="card-btn card-btn-cart" onclick="addToCart('Virtual Nourishment')">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                <button class="card-btn card-btn-download" onclick="downloadBook('Virtual Nourishment')">
                    <i class="fas fa-download"></i> description
                </button>
            </div>
        </div>
    </div>

    <div class="recommended-section">
        <h2><i class="fas fa-star"></i> Recommended Reading</h2>
        <a href="#" class="recommended-link">
            My Time here to Learn 
            <i class="fas fa-arrow-right"></i>
        </a>
        <div class="book-icons">
            <i class="fas fa-book"></i>
            <i class="fas fa-graduation-cap"></i>
            <i class="fas fa-lightbulb"></i>
            <i class="fas fa-university"></i>
            <i class="fas fa-feather-alt"></i>
        </div>
    </div>

    <footer>
        <p>books Collection &copy; 2023 | An allegorical exploration of digital consumption through social media</p>
        <p style="margin-top: 10px; font-size: 0.8rem;">All books are available in digital and print formats. Download samples before purchase.</p>
    </footer>

    

</body>
</html>
# Symfony + React Native Demo

This project demonstrates how to build a Symfony backend API and consume it with a React Native mobile app. It includes a web-based demo that can be hosted on GitHub Pages.

## Live Demo

Check out the live demo at: https://yourusername.github.io/your-repo-name/

## Project Structure

- `symfony-backend/` - Symfony RESTful API
- `react-native-app/` - React Native mobile application
- `docs/` - GitHub Pages demo website (showcases both the API and mobile app)

## Setup Instructions

### Local Development

#### 1. Clone the repository

```bash
git clone https://github.com/yourusername/your-repo-name.git
cd your-repo-name
```

#### 2. Using Docker (recommended)

The easiest way to run the entire project is using Docker:

```bash
docker-compose up -d
```

This will start:
- Symfony backend on http://localhost:8000
- MySQL database
- Web demo on http://localhost:8080

#### 3. Manual Setup

If you prefer to set up each component separately:

##### Symfony Backend

```bash
cd symfony-backend
composer install
# Configure your database in .env
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
symfony server:start
```

##### React Native App

```bash
cd react-native-app
npm install
npx expo start
```

##### GitHub Pages Demo

The demo page in the `docs/` folder can be served using any static file server:

```bash
cd docs
python -m http.server 8080
```

Then visit http://localhost:8080 in your browser.

## Deployment

### GitHub Pages Deployment

To deploy the demo to GitHub Pages:

1. Push your code to GitHub
2. Go to your repository settings
3. In the "GitHub Pages" section, select the "main" branch and "/docs" folder
4. Save the settings

Your demo will be available at https://yourusername.github.io/your-repo-name/

### Deploying the Symfony Backend

For a production environment, you'll need to deploy your Symfony backend to a server that supports PHP and MySQL. Options include:

- Traditional web hosting with PHP support
- VPS providers like DigitalOcean, AWS, or Heroku
- Platform-as-a-Service options like Platform.sh or Symfony Cloud

After deploying your backend, update the API URL in both the React Native app and the GitHub Pages demo.

## API Endpoints

- `GET /api/products` - Get all products
- `GET /api/products/{id}` - Get product by ID

## Customizing the Project

### Adding New Products

To add new products to the database:

1. Create a fixture in the Symfony backend
2. Load the fixture using `php bin/console doctrine:fixtures:load`

For the GitHub Pages demo, modify the products array in the JavaScript section of `docs/index.html`.

### Extending the API

To add more endpoints to the API:

1. Create new controller methods in `symfony-backend/src/Controller/ApiController.php`
2. Update the React Native app to use the new endpoints
3. Update the GitHub Pages demo to showcase the new endpoints

## Technologies Used

- **Backend:**
  - Symfony 6
  - Doctrine ORM
  - PHP 8

- **Frontend:**
  - React Native
  - Expo
  - React Navigation

- **Demo Page:**
  - HTML/CSS/JavaScript
  - TailwindCSS
  - PrismJS (for code highlighting)

# Project structure
/demo-project/
├── README.md                         # Project documentation
├── .gitignore                        # Git ignore file
├── docker-compose.yml                # Docker setup for local development
├── symfony-backend/                  # Symfony backend code
│   ├── composer.json
│   ├── .env
│   ├── src/
│   │   ├── Controller/
│   │   │   └── ApiController.php
│   │   ├── Entity/
│   │   │   └── Product.php
│   │   └── Repository/
│   │       └── ProductRepository.php
│   └── ...
├── react-native-app/                 # React Native app code
│   ├── App.js
│   ├── package.json
│   └── src/
│       ├── screens/
│       │   └── ProductListScreen.js
│       └── components/
│           └── ProductItem.js
└── docs/                             # GitHub Pages demo website
    ├── index.html                    # Main demo page
    ├── css/
    │   └── styles.css                # Styles for demo page
    ├── js/
    │   ├── main.js                   # Demo functionality
    │   └── mockApi.js                # Mock API for GitHub Pages demo
    └── images/
        └── iphone-frame.png          # iPhone mockup image

## License

This project is open source and available under the [MIT License](LICENSE).


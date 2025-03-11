# Symfony + React Native Integration Demo

This project demonstrates the integration of a Symfony backend API with a React Native mobile application.

## Overview

The project showcases how to:
- Build a RESTful API with Symfony
- Consume the API from a React Native mobile app
- Handle data exchange between backend and frontend

## Live Demo

View the live demo: [https://dariocostanzo.github.io/react-native-and-symfony/](https://dariocostanzo.github.io/react-native-and-symfony/)

## Project Structure

- `/symfony-backend` - Symfony backend application with REST API endpoints
- `/react-native-app` - React Native mobile application
- `/docs` - Documentation and interactive demo page

## Getting Started

### Backend Setup

1. Navigate to the symfony-backend directory
2. Run `composer install`
3. Configure your database in `.env`
4. Run migrations: `php bin/console doctrine:migrations:migrate`
5. Start the server: `symfony server:start`

### Mobile App Setup

1. Navigate to the react-native-app directory
2. Run `npm install`
3. Start the app: `npx react-native run-android` or `npx react-native run-ios`

## API Endpoints

- `GET /api/products` - Get all products
- `GET /api/products/{id}` - Get a specific product by ID

## Technologies Used

- Symfony 6
- React Native
- RESTful API
- JavaScript/TypeScript


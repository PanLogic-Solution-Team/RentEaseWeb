const express = require('express');
const cors = require('cors');
const customerRouter = require('./server/router/customer.router.js'); // Import your custom router

const app = express();
require('dotenv').config({ path: './.env' });

const port = process.env.PORT || 8000;  // Set default port to 8000 if not provided in .env
// Middlewares
app.use(cors());            // Enable Cross-Origin Resource Sharing
app.use(express.json());    // Parse JSON request bodies

// Define routes
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
    console.log('index.html');
    console.log(__dirname);
    console.log(__filename);
    
});

// Use the customerRouter for the '/api/customer' route
app.use('/api/customer', customerRouter);
console.log(`  http://localhost:${port}/api/customer`);
// Export the app instance for use in index.js
module.exports = { app };

const { Router } = require('express');  // Import Router from express

const router = Router();  // Create a router instance
require('dotenv').config({ path: './.env' });

const port = process.env.PORT || 8000;  // Set default port to 8000 if not provided in .env
// Define customer-specific routes
router.get('/', (req, res) => {
  res.json({ message: 'Welcome to the Customer API!' });
});



router.get('/info', (req, res) => {
  res.json({ data: "500k" });  // Just an example response
});
console.log(`  http://localhost:${port}/api/customer/info`);



// Export the router for use in app.js
module.exports = router;  // Use module.exports instead of export default

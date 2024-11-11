const { app } = require('./app.js');  // Import the express app
require('dotenv').config({ path: './.env' }); // Load environment variables

const port = process.env.PORT || 8000;  // Set default port to 8000 if not provided in .env

// Start the server
app.listen(port, () => {
  console.log(`Server running on http://localhost:${port}`);
  console.log(`API available at:`);
  console.log(`  http://localhost:${port}/api/customer`);
  console.log(`  http://localhost:${port}/api/customer/info`);
  console.log(`  http://localhost:${port}/api/customer/find-room`);
});

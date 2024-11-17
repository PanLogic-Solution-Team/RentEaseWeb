import dotenv from 'dotenv';
import color from 'colors'
import connectToDatabase from './server/Database/databaseConnection.js';
import { database } from './server/utils/constant.js';
import { app } from './app.js';
import mongoose from 'mongoose';

// Load environment variables from .env file
dotenv.config({
  path: './.env'
});

// Connect to MongoDB database
connectToDatabase();

// Add the port number from environment variables or default to 3000
const PORT = process.env.PORT || 8000;

// Run server
app.listen(PORT, () => {
  console.log(`Server is running on ===========Index.html file =======> http://localhost:${PORT}`.green);
  console.log(`http://localhost:${PORT}/api/v1/customer`.green)
  console.log(`http://localhost:${PORT}/api/v1/customer/info`.green)
});


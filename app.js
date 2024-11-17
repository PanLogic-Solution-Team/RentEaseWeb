import express from 'express';
import color from 'colors';
import cors from 'cors';
import dotenv from 'dotenv';
import Customer from './server/router/customerRouter.js';


dotenv.config(
); // Load environment variables

const app = express();
// Routes
app.use("/api/v1/customer", Customer); 


// Export the app
export { app };
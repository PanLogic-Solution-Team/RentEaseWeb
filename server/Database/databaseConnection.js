import mongoose from 'mongoose';
import dotenv from 'dotenv';

dotenv.config({ path: '../../.env' });

/**
 * Asynchronously connects to a MongoDB database using Mongoose.
 * The connection URI and database name are retrieved from environment variables.
 * If the connection is successful, a success message is logged to the console.
 * If there is an error during the connection attempt, an error message is logged
 * and the process exits with a failure code.
 */
const connectToDatabase = async () => {
  try {
    await mongoose.connect(process.env.MONGO_URI, {
      dbName: process.env.DATABASE_NAME || 'defaultDbName', // Ensure DATABASE_NAME is set in .env
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
    console.log(`Connected to MongoDB successfully at host: ${mongoose.connection.host}`);
  } catch (error) {
    console.error(`Error connecting to MongoDB: ${error.message}`);
    process.exit(1); // Exit process with failure
  }
};

export default connectToDatabase;

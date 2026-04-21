# Payment Integration Setup Guide

## Overview
This project now includes Stripe payment integration for processing customer orders. Follow these steps to set up and configure the payment system.

## Prerequisites
- Stripe account (create one at https://stripe.com)
- PHP 8.2+
- Composer
- Laravel 12

## Installation Steps

### 1. Install Stripe PHP SDK
The Stripe package has already been added to `composer.json`. Install dependencies:

```bash
composer install
```

### 2. Set Environment Variables
Add the following variables to your `.env` file:

```env
STRIPE_PUBLIC_KEY=pk_test_YOUR_PUBLIC_KEY_HERE
STRIPE_SECRET_KEY=sk_test_YOUR_SECRET_KEY_HERE
STRIPE_WEBHOOK_SECRET=whsec_YOUR_WEBHOOK_SECRET_HERE
```

**To get your keys:**
1. Log in to your Stripe Dashboard
2. Go to **Developers** → **API Keys**
3. Copy your **Publishable key** (starts with `pk_`)
4. Copy your **Secret key** (starts with `sk_`)
5. For webhook secret, go to **Webhooks** section

### 3. Run Database Migrations
A new migration has been added to add payment-related columns to the orders table:

```bash
php artisan migrate
```

This creates the following columns in the `orders` table:
- `payment_status` - tracks payment state (pending, completed, failed)
- `payment_method` - payment method used (e.g., 'stripe')
- `stripe_payment_intent_id` - Stripe PaymentIntent ID
- `stripe_charge_id` - Stripe Charge ID

### 4. Test the Integration

#### Using Stripe Test Cards
Stripe provides test card numbers for development. Use these on the checkout page:

- **Success**: `4242 4242 4242 4242`
- **Decline**: `4000 0000 0000 0002`
- **Requires Authentication**: `4000 2500 0000 3155`

For all test cards use:
- Any future expiration date (e.g., 12/25)
- Any 3-digit CVC (e.g., 123)

## File Structure

### New Files Created:
- `app/Http/Controllers/PaymentController.php` - Handles payment processing
- `resources/views/checkout/index.blade.php` - Checkout page with Stripe payment form
- `resources/views/checkout/success.blade.php` - Payment success page
- `resources/views/checkout/failed.blade.php` - Payment failure page
- `database/migrations/2026_04_21_180000_add_payment_fields_to_orders_table.php` - Database migration
- `config/services.php` - Updated with Stripe configuration

### Modified Files:
- `app/Http/Controllers/CartController.php` - Updated checkout to redirect to payment page
- `app/Models/Order.php` - Added payment-related fillable attributes
- `resources/views/products/show.blade.php` - Improved add to cart button styling
- `resources/views/products/index.blade.php` - Enhanced add to cart button styling
- `routes/web.php` - Added payment routes
- `composer.json` - Added Stripe package

## Payment Flow

1. **User adds products to cart**
   - Cart items are stored in the `carts` table

2. **User clicks "Proceed to Checkout"**
   - Redirected to `/payment/checkout`
   - Payment checkout page loads with order summary

3. **User enters payment details**
   - Stripe.js securely collects card information
   - Card details are NOT sent to your server

4. **Payment Processing**
   - PaymentIntent is created on the server
   - Payment is confirmed with Stripe
   - Order is created in database upon successful payment
   - Cart is cleared

5. **Payment Success/Failure**
   - User is redirected to success or failure page
   - Admin receives notification of new order
   - User receives order confirmation

## Key Features

✅ **Secure Payment Processing**
- PCI DSS compliant - card data never touches your server
- Stripe handles all payment security

✅ **Order Management**
- Orders are only created after successful payment
- Payment status is tracked in database
- Stripe IDs stored for reference and refunds

✅ **Notifications**
- Admin notifications for new paid orders
- User notifications for successful payments
- Real-time order status tracking

✅ **Error Handling**
- Proper error messages for failed payments
- User-friendly error pages
- Server-side validation

## Admin Features

### View Orders with Payment Status
In the admin dashboard (`/admin/orders`), you can:
- See payment status for each order
- View total amount paid
- Update order fulfillment status
- Track Stripe transaction IDs

## Testing & Debugging

### Enable Debug Mode
Set `APP_DEBUG=true` in `.env` for detailed error messages.

### View Stripe Logs
1. Go to Stripe Dashboard → Developers → Events
2. Check for any failed payment attempts
3. Review webhook delivery status

### Local Testing with Webhooks
For local development, you can use Stripe CLI to test webhooks:
```bash
stripe listen --forward-to localhost:8000/webhook/stripe
```

## Security Notes

⚠️ **Never commit API keys to version control**
- Use `.env` file (already in `.gitignore`)
- Rotate keys regularly
- Use restricted API keys with limited permissions

⚠️ **HTTPS Required in Production**
- Stripe requires HTTPS for live payment processing
- Update `STRIPE_PUBLIC_KEY` and `STRIPE_SECRET_KEY` to live keys when deploying

## Troubleshooting

### Payment shows "Processing Error"
- Check that `STRIPE_SECRET_KEY` is correct in `.env`
- Verify the key has no extra spaces or quotes
- Check Stripe Dashboard for error details

### Cards are declined
- In test mode, use test card numbers
- In production, verify SSL certificate is valid

### Orders not appearing after payment
- Run migrations: `php artisan migrate`
- Check Laravel logs: `storage/logs/laravel.log`
- Verify database permissions

## Support

For Stripe API documentation, visit:
https://stripe.com/docs

For Laravel Stripe integration help:
- Check official documentation
- Review error logs in `storage/logs/`

## Next Steps

1. Set up webhook handlers for production
2. Configure email notifications for order confirmations
3. Set up refund processing
4. Implement receipt generation
5. Add multi-currency support if needed

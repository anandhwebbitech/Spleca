 @extends('layouts.app')
 @section('content')
     <div class="thank-you-container">
         <div class="success-card">
             <div class="success-icon">
                 <i class="fas fa-check"></i>
             </div>
             <h1 class="success-title">Thank You!</h1>
             <p class="success-message">Your order has been successfully placed</p>
             <p class="success-message">We've sent a confirmation email to your registered email address</p>

             <div class="action-buttons1">
                 <button class="primary-btn" onclick="continueShopping()">
                     <i class="fas fa-shopping-cart"></i>
                     Continue Shopping
                 </button>
                 <button class="secondary-btn" onclick="viewOrders()">
                     <i class="fas fa-box"></i>
                     View Orders
                 </button>
             </div>
         </div>
     </div>
     <script>
         function continueShopping() {
             alert('Redirecting to shop...');
             // window.location.href = '/shop';
         }

         function viewOrders() {
             alert('Redirecting to your orders...');
             // window.location.href = '/orders';
         }

         // Animate the success card on page load
         window.addEventListener('load', () => {
             const successCard = document.querySelector('.success-card');
             successCard.style.opacity = '0';
             successCard.style.transform = 'translateY(20px)';

             setTimeout(() => {
                 successCard.style.transition = 'all 0.5s ease';
                 successCard.style.opacity = '1';
                 successCard.style.transform = 'translateY(0)';
             }, 100);
         });
     </script>
 @endsection

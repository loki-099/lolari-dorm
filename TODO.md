# TODO: Fix Foreign Key Constraint Violation for staff_id

## Problem
SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails
- The controllers use `Auth::id()` (users.id) but the foreign key expects staff_id from the staffs table

## Solution
1. [x] Analyze the issue - Understand that staffs table has its own auto-incrementing id
2. [x] Fix DatabaseSeeder.php - Create staff records when creating staff users
3. [x] Fix TransactionController.php - Look up or create staff ID by user_id
4. [x] Fix PaymentController.php - Look up or create staff ID by user_id
5. [x] Code is now robust - uses firstOrCreate to handle existing/new staff records


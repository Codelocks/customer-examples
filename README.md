# Codelocks Connect API

The Codelocks Connect API is a REST API which is provided to customers to retreive NetCodes for compatible Codelocks and Kitlock locks.

# What is NetCode

NetCode is the smart way to generate time-sensitive code which allow for temporary access to a compatible lock. NetCodes start at specific date and times for set durations.

## NetCode Notes

- NetCode is an algorithm based mechanism for generate time based code credentials on compatible Codelocks and Kitlock locks.
- NetCodes must begin at the start of an hour period.
- Day length NetCodes must start at midnight.
- The lock must have the NetCode function enabled (and the correct NetCode mode).
- NetCodes generated via the Codelocks Connect Portal are charged using a credit system.
- NetCode generated via the API charged on a per request basis.
- Multiple NetCodes (of varying start tiems and duration) can be requested for a single lock and be valid at any given time.
- If NetCode is requested using the same parameters then the same NetCode will be returned.

## NetCode Modes

The following NetCode modes are available (may vary depending on Lock Model):

- Standard Single Use: Between 1-12 hours and 1-7 days and can only be used once within that duration.
- Standard Multi-Use: Between 1-12 hours and 1-7 days and can only be used multiple times within that duration.
- Medium Term Rental (ACC Mode): Duration between 1-21 days and the code must be first used with 24 hours of the start date.
- Long Term Rental (URM Mode) - durations of up to 1 year and the code must be first used within the valid period (1-21 days) from the start date
- End Date - expiry on a set date (at midnight) up to 365 days from generation
- 24 hour - codes start on any hour and lasts for 24 hours.

For more information go to https://codelocksconnect.net

# API Notes

- API functionality (generation of NetCodes) can work in paralell with other supported access credentials (lock model specific).
- New API Customers are given a 14 day trial access to the API to test before committing to purchasing the developer programme.
- It is advised that the customer has a test lock to confirm returned NetCodes are working.
- API generated NetCodes are not recorded and thus will not appear in customer Codelocks Connect Portal account.

## Kitlock Range

- Kitlocks can either be initialised on the Codelocks Connect Portal (and the detaisl retrieved from the individual lock view) or initialised external to Codelocks infrastructure.
- Codelocks does not provide programmatic access to the list of locks and associated parameters for lock initialised on the Codelocks Connect Portal.

## Smart Lock Range

- K3Connect app (iOS and Android) is required to configure the lock.
- Programatic Access to list of locks associated with K3Connect account (different account to Codelocks Connect account) is available.

# More Information

Contact Codelocks support@codelocks.com or visit our website https://codelocksconnect.net  

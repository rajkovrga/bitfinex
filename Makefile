.PHONY: err
err:
	php artisan config:cache
	php artisan route:cache 
	php artisan optimize:clear
	php artisan view:clear
	php artisan view:cache
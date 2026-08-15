# Backend README

यो फोल्डरमा Laravel backend आउँछ। प्रारम्भिक सेटअप (स्थानीय विकास):

1. composer र npm इन्स्टल हुनु आवश्यक छ।
2. .env फाइल बनाउन: cp .env.example .env र आवश्यक मानहरू परिमार्जन गर्नुहोस्।
3. composer install
4. php artisan key:generate
5. docker-compose up -d
6. php artisan migrate --seed

नोट: यो scaffold प्रारम्भिक फाइलहरूसँग आएको छ; वास्तविक Laravel dependecies सर्भरमा इनस्टल गर्नुहोस्।

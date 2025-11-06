
# muminkhodzhaev_bot — готовый проект для Render (PHP webhook)

Файлы в архиве:
- `muminkhodzhaev.php` — главный webhook-скрипт (вставлен ваш токен).
- `composer.json` — минимальный, чтобы Render распознал проект.
- `README.md` — инструкция.

## Как запустить на Render.com (быстро)

1. Зарегистрируйтесь / войдите на https://render.com
2. Создайте новый **Web Service** → **Connect a repository**.
   - Если у вас нет GitHub-репозитория, создайте его и загрузите файлы, либо загрузите ZIP через репозиторий.
3. В настройках сервиса:
   - Environment: `PHP`
   - Build Command: (оставьте пустым или `composer install`)
   - Start Command: `php -S 0.0.0.0:10000`
4. После деплоя Render даст URL вида `https://<name>.onrender.com`.
   - Скопируйте URL и добавьте к нему имя файла, например: `https://<name>.onrender.com/muminkhodzhaev.php`.

## Установка webhook

В браузере откройте (замените <TOKEN> и <URL>):
https://api.telegram.org/bot<TOKEN>/setWebhook?url=<URL>

Пример:
https://api.telegram.org/bot8413209427:AAGzULqEmX0-6Zth7jjgVUUlDyuIDPOV4sU/setWebhook?url=https://muminkhodzhaev-bot.onrender.com/muminkhodzhaev.php

## Проверка состояния webhook
Откройте:
https://api.telegram.org/bot<TOKEN>/getWebhookInfo

## Безопасность
- Пересоздайте токен, если он был скомпрометирован. Никому не показывайте токен.
- Рекомендуется при установке webhook добавить параметр `secret_token` и проверять заголовок `X-Telegram-Bot-Api-Secret-Token` в скрипте.

# 1-yechim: Python 3.7+ uchun
import asyncio

from telegram.ext import ApplicationBuilder

from config import BOT_TOKEN
from main import main

if __name__ == '__main__':
    asyncio.run(main())

# 2-yechim: Agar yuqoridagi ishlamasa
if __name__ == '__main__':
    loop = asyncio.get_event_loop()
    loop.run_until_complete(main())
    loop.close()

# 3-yechim: python-telegram-bot 20.0+ versiyasi uchun
if __name__ == '__main__':
    application = ApplicationBuilder().token(BOT_TOKEN).build()
    # Barcha handler'larni qo'shing
    # ...
    application.run_polling()  # Bu o'zi asyncio loop'ni boshqaradi
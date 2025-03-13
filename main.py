import asyncio
import logging
from telegram.ext import ApplicationBuilder, CommandHandler, MessageHandler, CallbackQueryHandler, filters, \
	ConversationHandler

# Import configuration
from config import BOT_TOKEN

# Import database
from database.db import init_db

# Import handlers
from bot.handlers.start import start_handler, subscription_callback_handler
from bot.handlers.video import video_url_handler, process_video
from bot.handlers.music import music_search_handler, voice_message_handler
from bot.handlers.admin import (
	admin_panel_handler, stats_handler, send_ad_handler,
	add_channel_handler, channel_callback_handler,
	WAITING_FOR_AD, WAITING_FOR_CHANNEL
)

# Configure logging
logging.basicConfig(
	format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
	level=logging.INFO
)
logger = logging.getLogger(__name__)

async def main():
	# Initialize database
	init_db()
	
	# Create the Application
	application = ApplicationBuilder().token(BOT_TOKEN).build()
	
	# Add handlers
	# User interface handlers
	application.add_handler(CommandHandler("start", start_handler))
	application.add_handler(MessageHandler(filters.TEXT & ~filters.COMMAND & filters.Entity("url"), video_url_handler))
	application.add_handler(
		MessageHandler(filters.TEXT & ~filters.COMMAND & ~filters.Entity("url"), music_search_handler))
	application.add_handler(MessageHandler(filters.VOICE, voice_message_handler))
	
	# Admin panel handlers
	application.add_handler(CommandHandler("admin", admin_panel_handler))
	application.add_handler(CommandHandler("stats", stats_handler))
	
	# Conversation handlers for admin actions
	send_ad_conv = ConversationHandler(
		entry_points=[CommandHandler("sendad", send_ad_handler)],
		states={
			WAITING_FOR_AD: [MessageHandler(filters.ALL & ~filters.COMMAND, send_ad_handler)],
		},
		fallbacks=[CommandHandler("cancel", lambda u, c: ConversationHandler.END)]
	)
	application.add_handler(send_ad_conv)
	
	add_channel_conv = ConversationHandler(
		entry_points=[CommandHandler("addchannel", add_channel_handler)],
		states={
			WAITING_FOR_CHANNEL: [MessageHandler(filters.TEXT & ~filters.COMMAND, add_channel_handler)],
		},
		fallbacks=[CommandHandler("cancel", lambda u, c: ConversationHandler.END)]
	)
	application.add_handler(add_channel_conv)
	
	# Callback query handlers
	application.add_handler(CallbackQueryHandler(subscription_callback_handler, pattern="^check_subscription$"))
	application.add_handler(CallbackQueryHandler(channel_callback_handler, pattern="^channel_"))
	application.add_handler(CallbackQueryHandler(process_video, pattern="^download_"))
	
	# Start the Bot
	await application.initialize()
	await application.start()
	await application.updater.start_polling()
	
	# Run the bot until the user presses Ctrl-C
	await application.idle()

if __name__ == '__main__':
	# Python 3.7+ uchun
	asyncio.run(main())

# Agar yuqoridagi ishlamasa, quyidagini sinab ko'ring:
# loop = asyncio.get_event_loop()
# loop.run_until_complete(main())
# loop.close()
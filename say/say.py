from gtts import gTTS
import os
say = ''
while(say != 'quit'):
	say = input('What to Say: ')
	tts = gTTS(say, 'en')
	tts.save('say.mp3')
	os.system('say.mp3')
	os.system('')

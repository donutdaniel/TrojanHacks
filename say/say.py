from gtts import gTTS
import os
say = ''
while(say != 'Quit'):
	say = input('What to Say: ')
	tts = gTTS(say, 'es')
	tts.save('test.mp3')
	os.system('start "" test.mp3')
	os.system('')
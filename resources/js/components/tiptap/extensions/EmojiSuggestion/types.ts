// import { EmojiItem } from '@tiptap-pro/extension-emoji'
import { EmojiItem } from '../fake-pro'

export interface Command {
  name: string
}

export interface EmojiListProps {
  command: (command: Command) => void
  items: EmojiItem[]
}

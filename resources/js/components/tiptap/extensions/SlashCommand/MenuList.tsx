import React, { useCallback, useEffect, useRef, useState } from 'react'

import { Command, MenuListProps } from './types'
import { CommandButton } from './CommandButton'
import { Surface } from '../../components/ui/Surface'
import { DropdownButton } from '../../components/ui/Dropdown'
import { Icon } from '../../components/ui/Icon'

const useScrollToActiveEffect = (
  selectedCommandIndex: number,
  selectedGroupIndex: number,
  activeItem: React.MutableRefObject<HTMLButtonElement | null>,
  scrollContainer: React.MutableRefObject<HTMLDivElement | null>,
  items: MenuListProps['items'],
) => {
  const lastGroupIndex = items.length - 1
  const lastCommandIndex = items.length > 0 ? items[lastGroupIndex].commands.length - 1 : 0

  useEffect(() => {
    if (activeItem.current && scrollContainer.current) {
      const paddingBottom = 10
      const paddingTop = 10

      const itemOffsetTop = activeItem.current.offsetTop
      const itemOffsetHeight = activeItem.current.offsetHeight
      const containerClientHeight = scrollContainer.current.clientHeight
      const containerScrollTop = scrollContainer.current.scrollTop

      if (itemOffsetTop + itemOffsetHeight > containerClientHeight + containerScrollTop - paddingBottom) {
        const isLastSelected = selectedGroupIndex === lastGroupIndex && selectedCommandIndex === lastCommandIndex
        scrollContainer.current.scrollTop = isLastSelected
          ? scrollContainer.current.scrollHeight
          : itemOffsetTop + itemOffsetHeight - containerClientHeight + paddingBottom
      } else if (itemOffsetTop < containerScrollTop + paddingTop) {
        const isFirstSelected = selectedCommandIndex === 0 && selectedGroupIndex === 0
        scrollContainer.current.scrollTop = isFirstSelected ? 0 : itemOffsetTop - paddingTop
      }
    }
  }, [selectedCommandIndex, selectedGroupIndex, lastCommandIndex, lastGroupIndex, activeItem, scrollContainer])
}

export const MenuList = React.forwardRef((props: MenuListProps, ref) => {
  const scrollContainer = useRef<HTMLDivElement>(null)
  const activeItem = useRef<HTMLButtonElement>(null)
  const [selectedGroupIndex, setSelectedGroupIndex] = useState(0)
  const [selectedCommandIndex, setSelectedCommandIndex] = useState(0)

  // Anytime the groups change, i.e. the user types to narrow it down, we want to
  // reset the current selection to the first menu item
  useEffect(() => {
    setSelectedGroupIndex(0)
    setSelectedCommandIndex(0)
  }, [props.items])

  const selectItem = useCallback(
    (groupIndex: number, commandIndex: number) => {
      const command = props.items[groupIndex].commands[commandIndex]
      props.command(command)
    },
    [props],
  )

  React.useImperativeHandle(ref, () => ({
    onKeyDown: ({ event }: { event: React.KeyboardEvent }) => {
      if (event.key === 'ArrowDown') {
        if (!props.items.length) {
          return false
        }

        const commands = props.items[selectedGroupIndex].commands

        let newCommandIndex = selectedCommandIndex + 1
        let newGroupIndex = selectedGroupIndex

        if (commands.length - 1 < newCommandIndex) {
          newCommandIndex = 0
          newGroupIndex = selectedGroupIndex + 1
        }

        if (props.items.length - 1 < newGroupIndex) {
          newGroupIndex = 0
        }

        setSelectedCommandIndex(newCommandIndex)
        setSelectedGroupIndex(newGroupIndex)

        return true
      }

      if (event.key === 'ArrowUp') {
        if (!props.items.length) {
          return false
        }

        let newCommandIndex = selectedCommandIndex - 1
        let newGroupIndex = selectedGroupIndex

        if (newCommandIndex < 0) {
          newGroupIndex = selectedGroupIndex - 1
          newCommandIndex = props.items[newGroupIndex]?.commands.length - 1 || 0
        }

        if (newGroupIndex < 0) {
          newGroupIndex = props.items.length - 1
          newCommandIndex = props.items[newGroupIndex].commands.length - 1
        }

        setSelectedCommandIndex(newCommandIndex)
        setSelectedGroupIndex(newGroupIndex)

        return true
      }

      if (event.key === 'Enter') {
        if (!props.items.length || selectedGroupIndex === -1 || selectedCommandIndex === -1) {
          return false
        }

        selectItem(selectedGroupIndex, selectedCommandIndex)

        return true
      }

      return false
    },
  }))

  useScrollToActiveEffect(selectedCommandIndex, selectedGroupIndex, activeItem, scrollContainer, props.items)

  const createCommandClickHandler = useCallback(
    (groupIndex: number, commandIndex: number) => {
      return () => {
        selectItem(groupIndex, commandIndex)
      }
    },
    [selectItem],
  )

  if (!props.items.length) {
    return null
  }

  return (
    <Surface ref={scrollContainer} className="text-black max-h-[min(80vh,24rem)] overflow-auto flex-wrap mb-8 p-2">
      <div className="grid grid-cols-1 gap-0.5">
        {props.items.map((group, groupIndex: number) => (
          <React.Fragment key={`${group.title}-wrapper`}>
            <div
              className="text-neutral-500 text-[0.65rem] col-[1/-1] mx-2 mt-4 font-semibold tracking-wider select-none uppercase first:mt-0.5"
              key={`${group.title}`}
            >
              {group.title}
            </div>
            {group.commands.map((command: Command, commandIndex: number) => (
              <DropdownButton
                key={`${command.label}`}
                isActive={selectedGroupIndex === groupIndex && selectedCommandIndex === commandIndex}
                onClick={createCommandClickHandler(groupIndex, commandIndex)}
                ref={
                  selectedGroupIndex === groupIndex && selectedCommandIndex === commandIndex ? activeItem : undefined
                }
              >
                <Icon name={command.iconName} className="mr-1" />
                {command.label}
              </DropdownButton>
            ))}
          </React.Fragment>
        ))}
      </div>
    </Surface>
  )
})

MenuList.displayName = 'MenuList'

export default MenuList

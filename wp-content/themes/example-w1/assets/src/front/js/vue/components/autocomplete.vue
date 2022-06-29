<template>
    <div ref="autocomplete" class="input-group autocomplete">
        <label :for="id" class="sr-only">{{placeholder}}</label>
        <input class="our-clubs__search-input mat-input" :class="{ loading }" :id="id" @input="search" v-model="query" name="query" type="text" autocomplete="off" :placeholder="placeholder">
        <slot name="buttons"></slot>
        <button class="button button--big button--primary with-icon our-clubs__search-submit" :aria-label="buttonText" v-on:click="onFind">
            <div class="cf-loading" v-if="loading"></div>
            <span class="short">{{shortButtonText}}</span>
            <span class="long">{{buttonText}}</span>
            <i class="icon icon-magnifier"></i>
        </button>
        <div class="autocomplete__list" v-if="options.length > 0 && visibleResults">
            <div
              :class="['autocomplete__option', { 'autocomplete__option--selected': isSelected(index) }]"
              v-for="(option, index) in options"
              :key="option.label"
              v-on:click="onClickOption(option)"
              v-html="option.labelHTML"
            ></div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'autocomplete',
    props: {
      placeholder: {
        default: '',
        type: String
      },
      buttonText: {
        default: '',
        type: String
      },
      shortButtonText: {
        default: '',
        type: String,
      },
      id: {
        default: '',
        type: String
      },
      filterResults: {
        default: function() {return []},
        type: Function
      },
      value: {
        default: '',
        type: String
      },
      loading: {
        default: false,
        type: Boolean
      }
    },
    mounted()
    {
      document.addEventListener('click', (event) => {
        if (this.$refs.autocomplete.contains(event.target) === false) {
          this.visibleResults = false;
        }
      });
    },
    data() {
      return {
        options: [],
        query: this.value,
        visibleResults: true,
        selected: null
      }
    },
    watch: {
      value(value)
      {
        this.query = value;
      },
      query(value)
      {
        this.$emit('input', value);
      }
    },
    methods: {
      search(event)
      {
        let key = event.keyCode;
        
        if (key === 40 || key === 38) {
            let keyDirection = key === 40 ? 'down' : 'up'
            let indexLast = this.options.length - 1;

            if (this.selected === null) {
                this.selected = keyDirection === 'down' ? 0 : indexLast
            } else if (keyDirection === 'down') {
                this.selected = this.selected === indexLast ? 0 : this.selected + 1
            } else if (keyDirection === 'up') {
                this.selected = this.selected === 0 ? this.deselect() : this.selected - 1
            }
            return;
        }

        if (key === 13 && this.selected !== null) {
          this.onClickOption(this.options[this.selected]);
          return;
        }

        this.visibleResults = true;
        debounce(() => {

          // it seems like v-model is setted just after input event on android phones
          // solved it with kinda strange way, but it works :>
          const query = event.target.value;
          this.options = this.filterResults(query, event);
        }, 400, false);
      },
      onFind()
      {
        this.$emit('find', this.query);
      },
      onClickOption(option)
      {
        this.selected = null;
        this.visibleResults = false;
        this.query = option.label;
        this.$emit('update:position', option.value);
      },
      isSelected(index) 
      {
        return this.selected === index;
      },
      deselect() {
        this.selected = null;
      }
    }
  };
</script>
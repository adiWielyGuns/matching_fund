<script setup>
import select2 from "select2";
import $ from "jquery";
import _ from "lodash";

const props = defineProps({
  opsi: {
    default: [],
  },
  value: {
    default: null,
  },
  url: {
    default: null,
  },
  tags: {
    default: null,
  },
  async: {
    default: undefined,
  },
  placeholder: {
    default: null,
  },
  multiple: {
    default: false,
  },
  maximumSelectionLength: {
    default: false,
  },
});

defineEmits(["update:modelValue"]);
</script>
<template>
  <select>
    <slot></slot>
  </select>
</template>

<script>
// Returns the number of full stop in given string.

export default {
  name: "select2",
  data: function () {
    return {
      ajaxOptions: {
        url: this.url,
        dataType: "json",
        delay: 250,
        tags: true,
        data: function (params) {
          return {
            param: params.term, // search term
            page: params.page,
          };
        },
        processResults: function (data, params) {
          params.page = params.page || 1;
          return {
            pagination: {
              more: params.page * 30 < data.total_count,
            },
            results: data.data,
          };
        },
        cache: true,
      },
    };
  },
  watch: {
    value: function (value) {
      // update value
      $(this.$el).val(value).trigger("change");
    },
    opsi: function (opsi) {
      // update opsi
      $(this.$el).select2({
        data: opsi,
      });
    },
    url: function (value) {
      this.ajaxOptions.url = this.url;
      if (this.async == undefined) {
        $(this.$el).select2({
          tags: this.tags == undefined ? false : this.tags,
          theme: "bootstrap",
          data: this.opsi,
          width: "100%",
          maximumSelectionLength:
            this.maximumSelectionLength == undefined
              ? false
              : this.maximumSelectionLength,
          ajax: this.ajaxOptions,
          placeholder:
            this.placeholder == undefined ? "Click to search" : this.placeholder,
          templateSelection: this.formatRepoSelection,
          templateResult: this.formatRepo,
        });
      } else {
        this.async
          ? $(this.$el).select2({
              tags: this.tags == undefined ? false : this.tags,
              theme: "bootstrap",
              data: this.opsi,
              width: "100%",
              maximumSelectionLength:
                this.maximumSelectionLength == undefined
                  ? false
                  : this.maximumSelectionLength,
              ajax: this.ajaxOptions,
              placeholder:
                this.placeholder == undefined ? "Click to search" : this.placeholder,
              templateSelection: this.formatRepoSelection,
              templateResult: this.formatRepo,
            })
          : $(this.$el).select2({
              tags: this.tags == undefined ? false : this.tags,
              theme: "bootstrap",
              data: this.opsi,
              width: "100%",
              maximumSelectionLength:
                this.maximumSelectionLength == undefined
                  ? false
                  : this.maximumSelectionLength,
              placeholder:
                this.placeholder == undefined ? "Click to search" : this.placeholder,
            });
      }
    },
    destroyed: function () {
      $(this.$el).off().select2("destroy");
    },
  },
  mounted: function () {
    var vm = this;
    var par = $(vm.$el).parent("div").find(".select2");
    select2();
    $(vm.$el).prop("multiple", this.multiple);
    document.addEventListener("click", function (event) {
      var par = $(vm.$el).parent("div").find(".select2");

      event.path.forEach((d, i) => {
        if ($(d).get(0) === par.get(0)) {
          setTimeout(
            () => document.getElementsByClassName("select2-search__field")[0]?.focus(),
            100
          );
        }
      });
    });
    if (this.async) {
      $(this.$el)
        .select2({
          tags: this.tags == undefined ? false : this.tags,
          maximumSelectionLength:
            this.maximumSelectionLength == undefined
              ? false
              : this.maximumSelectionLength,
          theme: "bootstrap",
          data: this.opsi,
          width: "100%",
          placeholder:
            this.placeholder == undefined ? "Click to search" : this.placeholder,
          ajax: this.ajaxOptions,
          templateSelection: this.formatRepoSelection,
          templateResult: this.formatRepo,
        })
        .val(this.value)
        .trigger("change")
        // emit event on change.
        .on("select2:select", function (e) {
          vm.$emit("input", this.value);
        });
    } else {
      this.async
        ? $(this.$el)
            // init select2
            .select2({
              tags: this.tags == undefined ? false : this.tags,
              maximumSelectionLength:
                this.maximumSelectionLength == undefined
                  ? false
                  : this.maximumSelectionLength,
              theme: "bootstrap",
              data: this.opsi,
              width: "100%",
              placeholder:
                this.placeholder == undefined ? "Click to search" : this.placeholder,
              ajax: this.ajaxOptions,
              templateSelection: this.formatRepoSelection,
              templateResult: this.formatRepo,
            })
            .val(this.value)
            .trigger("change")
            // emit event on change.
            .on("select2:select", function (e) {
              vm.$emit("input", this.value);
            })
        : $(this.$el)
            // init select2
            .select2({
              tags: this.tags == undefined ? false : this.tags,
              maximumSelectionLength:
                this.maximumSelectionLength == undefined
                  ? false
                  : this.maximumSelectionLength,
              theme: "bootstrap",
              data: this.opsi,
              width: "100%",
              placeholder:
                this.placeholder == undefined ? "Click to search" : this.placeholder,
            })
            .val(this.value)
            .trigger("change")
            // emit event on change.
            .on("select2:select", function (e) {
              vm.$emit("input", $(vm.$el).val());
            })
            .on("select2:unselect", function (e) {
              vm.$emit("input", $(vm.$el).val());
            });
    }
  },
  methods: {
    formatRepo: function (repo) {
      if (repo.loading) {
        return repo.text;
      }
      // scrolling can be used
      var markup = $("<span value=" + repo.id + ">" + repo.text + "</span>");
      return markup;
    },
    formatRepoSelection: function (repo) {
      return repo.text;
    },
  },
};
</script>

<style></style>
